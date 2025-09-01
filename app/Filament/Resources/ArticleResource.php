<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'مقالات';

    protected static ?string $modelLabel = 'مقاله';

    protected static ?string $pluralModelLabel = 'مقالات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات اصلی')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان مقاله')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', Article::createSlug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('category_id')
                            ->label('دسته‌بندی')
                            ->options(Category::active()->ordered()->pluck('name', 'id'))
                            ->required()
                            ->searchable(),

                        Forms\Components\Textarea::make('excerpt')
                            ->label('خلاصه مقاله')
                            ->rows(3)
                            ->maxLength(500),

                        Forms\Components\FileUpload::make('featured_image')
                            ->label('تصویر شاخص')
                            ->image()
                            ->directory('articles')
                            ->visibility('public'),
                    ])->columns(2),

                Forms\Components\Section::make('محتوای مقاله')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('محتوای مقاله')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('منبع و وضعیت')
                    ->schema([
                        Forms\Components\TextInput::make('source_url')
                            ->label('لینک منبع')
                            ->url()
                            ->maxLength(500),

                        Forms\Components\TextInput::make('source_name')
                            ->label('نام منبع')
                            ->maxLength(255),

                        Forms\Components\Select::make('status')
                            ->label('وضعیت')
                            ->options([
                                'draft' => 'پیش‌نویس',
                                'published' => 'منتشر شده',
                                'archived' => 'آرشیو شده',
                            ])
                            ->default('draft')
                            ->required(),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('تاریخ انتشار')
                            ->visible(fn (callable $get) => $get('status') === 'published'),
                    ])->columns(2),

                Forms\Components\Section::make('SEO و متادیتا')
                    ->schema([
                        Forms\Components\KeyValue::make('meta_data')
                            ->label('متادیتای اضافی')
                            ->keyLabel('کلید')
                            ->valueLabel('مقدار'),

                        Forms\Components\KeyValue::make('seo_data')
                            ->label('داده‌های SEO')
                            ->keyLabel('کلید')
                            ->valueLabel('مقدار'),
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('تصویر')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('دسته‌بندی')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('وضعیت')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                        'danger' => 'archived',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'پیش‌نویس',
                        'published' => 'منتشر شده',
                        'archived' => 'آرشیو شده',
                    }),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('تاریخ انتشار')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('view_count')
                    ->label('بازدید')
                    ->sortable(),

                Tables\Columns\TextColumn::make('source_name')
                    ->label('منبع')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('دسته‌بندی')
                    ->options(Category::active()->ordered()->pluck('name', 'id')),

                Tables\Filters\SelectFilter::make('status')
                    ->label('وضعیت')
                    ->options([
                        'draft' => 'پیش‌نویس',
                        'published' => 'منتشر شده',
                        'archived' => 'آرشیو شده',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
