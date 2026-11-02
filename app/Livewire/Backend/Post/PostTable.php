<?php

namespace App\Livewire\Backend\Post;

use App\Models\Post;
use App\Support\Seo\SeoAnalyzer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class PostTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Post::query())
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('post_image'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'archived' => 'info',
                        'draft' => 'warning',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('seo_score')
                    ->label('SEO')
                    ->badge()
                    ->state(fn (Post $record): string => $this->seoScore($record) . '%')
                    ->color(function (Post $record): string {
                        $score = $this->seoScore($record);

                        return $score >= 80 ? 'success' : ($score >= 50 ? 'warning' : 'danger');
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make('edit')
                    ->url(fn (Post $record): string => route('admin.post.edit', $record))
                    ->button()
                    ->color('info'),
                Tables\Actions\DeleteAction::make('delete')
                    ->requiresConfirmation()
                    ->button()
                    ->action(fn (Post $record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    protected function seoScore(Post $record): int
    {
        return SeoAnalyzer::analyze([
            'title' => $record->title,
            'excerpt' => $record->excerpt,
            'content' => $record->content,
            'meta_title' => $record->meta_title,
            'meta_description' => $record->meta_description,
            'focus_keyword' => $record->focus_keyword,
            'slug' => $record->slug,
            'canonical_url' => $record->canonical_url,
        ], app()->getLocale(), (bool) $record->seo_image)['score'];
    }

    public function render(): View
    {
        return view('livewire.backend.post.post-table');
    }
}
