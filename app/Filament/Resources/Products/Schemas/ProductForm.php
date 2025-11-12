<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        if (($get('slug') ?? '') !== Str::slug($old)) {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('sku')
                    ->label('SKU'),
                TextInput::make('cost_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('mrp')
                    ->required()
                    ->numeric(),
                TextInput::make('selling_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Textarea::make('summary'),
                RichEditor::make('description')
                    ->columnSpanFull(),
                KeyValue::make('attributes')
                    ->label('Product Attributes')
                    ->keyLabel('Attribute Name')
                    ->valueLabel('Attribute Value')
                    ->reorderable()
                    ->addable()
                    ->deletable()
                    ->keyPlaceholder('e.g., Color')
                    ->valuePlaceholder('e.g., Red')
                    ->columnSpanFull() // Makes it full width
                    ->default([]),
                TextInput::make('stock_quantity')
                    ->required()
                    ->default('0'),
                Select::make('brand_id')
                    ->relationship('brand', 'title'),
                Select::make('category_id')
                    ->relationship('category', 'title')
                    ->required(),
                FileUpload::make('images')
                    ->label('Product Images')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(10)
                    ->directory('products/images')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->columnSpanFull()
                    ->helperText('Upload product images. You can reorder them by dragging.'),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('sort_order')
                    ->default('0'),
            ]);
    }
}
