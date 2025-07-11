<?php

namespace App\Livewire\Backend\Post;

use Filament\Forms;
use App\Models\Post;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Contracts\Plugin;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use App\Livewire\Trait\FrimzTranslatableFields;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

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
                    Forms\Components\TextInput::make('user_id')
                        ->label('Author')
                        ->default(auth()->user()->id)
                        ->readOnly(),
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->translatable(),
                    Forms\Components\Textarea::make('excerpt')
                        ->required()
                        ->maxLength(255)
                        ->translatable(),
                    Forms\Components\RichEditor::make('content')
                        ->required()
                        ->translatable(),
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
                ])->columnSpan(['xl' => 4]),
            ])
            ->columns(12)
            ->statePath('data')
            ->model(Post::class);
    }

    public function create()
    {
        $data = $this->form->getState();
        dd($data);

        $record = Post::create($data);

        $this->form->model($record)->saveRelationships();

        return redirect()->route('admin.post.index')->with('flash_success', 'Article created successfully.');

    }

    public function render(): View
    {
        return view('livewire.backend.post.post-create');
    }
}
