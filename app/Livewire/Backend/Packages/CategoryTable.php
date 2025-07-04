<?php

namespace App\Livewire\Backend\Packages;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Contracts\Plugin;
use App\Models\PackageCategory;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\Trait\FrimzTranslatableFields;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class CategoryTable extends Component implements HasForms, HasTable, Plugin
{
    use InteractsWithForms;
    use InteractsWithTable;
    use FrimzTranslatableFields;

    public function table(Table $table): Table
    {
        return $table
            ->query(PackageCategory::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('layout'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                DeleteAction::make('delete')
                    ->requiresConfirmation()
                    ->button()
                    ->action(fn (PackageCategory $record) => $record->delete()),
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\Select::make('layout')
                            ->options([
                                'default' => 'Default',
                                'slider' => 'Slider',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->translatable(),
                        Forms\Components\Textarea::make('description')->translatable(),
                        Forms\Components\Textarea::make('note')->translatable(),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                    ])
                    ->color('info')
                    ->button()
                    ->modalHeading('Edit Category')
                    ->modalSubmitActionLabel('Update Category'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.backend.packages.category-table');
    }
}
