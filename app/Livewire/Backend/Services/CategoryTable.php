<?php

namespace App\Livewire\Backend\Services;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\ServicesCategory;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Concerns\InteractsWithTable;

class CategoryTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(ServicesCategory::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                DeleteAction::make('delete')
                    ->requiresConfirmation()
                    ->button()
                    ->action(fn (ServicesCategory $record) => $record->delete()),
                Tables\Actions\EditAction::make()
                    ->form([
                        TextInput::make('name')
                            ->label('Category Name')
                            ->required()
                            ->maxLength(255),
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
        return view('livewire.backend.services.category-table');
    }
}
