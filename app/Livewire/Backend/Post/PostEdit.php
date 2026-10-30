<?php

namespace App\Livewire\Backend\Post;

use App\Livewire\Trait\FrimzTranslatableFields;
use App\Models\Post;
use Filament\Contracts\Plugin;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PostEdit extends Component implements HasForms, Plugin
{
    use InteractsWithForms, FrimzTranslatableFields;

    public ?array $data = [];

    public Post $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                 Section::make()->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->translatable(),
                    Forms\Components\Textarea::make('excerpt')
                        ->maxLength(255)
                        ->required()
                        ->translatable(),
                    // Forms\Components\RichEditor::make('content')
                    //     ->required()
                    //      ->toolbarButtons([
                    //         'blockquote',
                    //         'bold',
                    //         'bulletList',
                    //         'italic',
                    //         'link',
                    //         'orderedList',
                    //         'redo',
                    //         'undo',
                    //     ])
                    //     ->translatable(),
                    TiptapEditor::make('content')
                        ->profile('default')
                        ->output(TiptapOutput::Html) // optional, change the format for saved data, default is html
                        ->maxContentWidth('5xl')
                        ->extraInputAttributes([
                            'style' => 'min-height: 300px; height: 500px;',
                        ])
                        ->required()
                        ->translatable()
                ])->columnSpan(['xl' => 9]),
                Section::make()->schema([
                    SpatieMediaLibraryFileUpload::make('image')
                        ->collection('post_image')
                        ->image()
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published',
                            'archived' => 'Archived',
                        ])
                        ->required(),
                ])->columnSpan(['xl' => 3]),
            ])
            ->columns(12)
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();
        $this->record->update($data);

        return redirect()->route('admin.post.index')->with('flash_success', 'Article created successfully.');

    }

    public function render(): View
    {
        return view('livewire.backend.post.post-edit');
    }
}
