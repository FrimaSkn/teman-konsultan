<?php

namespace App\Livewire\Backend\Packages;

use Filament\Tables;
use App\Models\Package;
use App\Models\PackageCategory;
use Livewire\Component;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class PackagesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Package::query())
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('nama paket')
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                    ->searchable()
                    ->sortable(),
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
                    ->options(PackageCategory::all()->pluck('name', 'id'))
            ])
            ->actions([
                Tables\Actions\EditAction::make('edit')
                    ->url(fn (Package $record): string => route('admin.packages.edit', $record))
                    ->button()
                    ->color('info'),
                Tables\Actions\DeleteAction::make('delete')
                    ->requiresConfirmation()
                    ->button()
                    ->action(fn (Package $record) => $record->delete())
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.backend.packages.packages-table');
    }
}
