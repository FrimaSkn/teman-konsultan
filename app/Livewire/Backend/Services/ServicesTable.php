<?php

namespace App\Livewire\Backend\Services;

use Filament\Tables;
use Livewire\Component;
use App\Models\Services;
use Filament\Tables\Table;
use App\Models\ServicesCategory;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ServicesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Services::query())
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Service')
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
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->options(ServicesCategory::all()->pluck('name', 'id'))
            ])
            ->actions([
                Tables\Actions\EditAction::make('page')
                    ->label('Page')
                    ->url(fn (Services $record): string => route('admin.services.page', $record))
                    ->button()
                    ->color('primary'),
                Tables\Actions\EditAction::make('edit')
                    ->url(fn (Services $record): string => route('admin.services.edit', $record))
                    ->button()
                    ->color('info'),
                DeleteAction::make('delete')
                    ->requiresConfirmation()
                    ->button()
                    ->action(fn (Services $record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.backend.services.services-table');
    }
}
