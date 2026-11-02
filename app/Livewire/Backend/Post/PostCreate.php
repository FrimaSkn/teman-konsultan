<?php

namespace App\Livewire\Backend\Post;

use App\Livewire\Backend\Post\Forms\PostSeoForm;
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

class PostCreate extends Component implements HasForms, Plugin
{
    use InteractsWithForms, FrimzTranslatableFields;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
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
                        ->required()
                        ->maxLength(255)
                        ->translatable(),
                    // Forms\Components\RichEditor::make('content')
                    //     ->required()
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
                ])->columnSpan(['xl' => 8]),
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
                        PostSeoForm::schema(),
                ])->columnSpan(['xl' => 4]),
            ])
            ->columns(12)
            ->statePath('data')
            ->model(Post::class);
    }

    public function create()
    {
        $data = $this->form->getState();
        $data['user_id'] = auth()->id(); // Set the user_id to the currently authenticated user

        $record = Post::create($data);

        $this->form->model($record)->saveRelationships();

        return redirect()->route('admin.post.index')->with('flash_success', 'Article created successfully.');

    }

    public function render(): View
    {
        return view('livewire.backend.post.post-create');
    }
}
