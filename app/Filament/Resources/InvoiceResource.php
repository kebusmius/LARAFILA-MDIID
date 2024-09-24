<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use App\Models\Esmdiid;
use App\Models\Espelanggan;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str; 


class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $navigationGroup = 'Invoices';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('nomor_invoice')
                //     ->label('Nomor Invoice'),
                    //->disabled(),
                    // ->default(function () {
                    //     // Generate a unique invoice number
                    //     $number = 'INV-' . strtoupper(Str::random(8));
                    //     while (Invoice::where('no_invoice', $number)->exists()) {
                    //         $number = 'INV-' . strtoupper(Str::random(8));
                    //     }
                    //     return $number;
                    // }),

                Select::make('esmdiid_id')
                    ->label('Nama Perusahaan')
                    ->relationship('esmdiid', 'nama')
                    ->required()
                    ->afterStateUpdated(fn (callable $set) => $set('espelanggan_id', null)),

                Select::make('espelanggan_id')
                    ->label('Nomor Telepon')
                    ->options(function (callable $get) {
                        $esmdiidId = $get('esmdiid_id');
                        if ($esmdiidId) {
                            return Espelanggan::where('esmdiid_id', $esmdiidId)
                                ->pluck('no_customer', 'id')
                                ->toArray();
                        }
                        return [];
                    })
                    ->required()
                    ->reactive()
                    ->placeholder('Pilih Nomor Telepon')
                    ->searchable(),

                DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required(),                

                Repeater::make('barang')
                    ->label('Data Produk')                    
                    ->schema([
                        Select::make('produk_id')
                            ->label('Produk')
                            ->options(Produk::pluck('nama', 'id'))
                            ->required(),

                        TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state, $get) {
                                $quantity = $get('quantity') ?? 0;
                                $set('total', ($state ?? 0) * $quantity);
                            }),

                        TextInput::make('quantity')
                            ->label('Quantity')
                            ->numeric()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state, $get) {
                                $price = $get('price') ?? 0;
                                $set('total', $price * ($state ?? 0));
                            }),

                        TextInput::make('total')
                            ->label('Total')
                            ->numeric()
                            ->disabled()
                            ->reactive(),
                    ])
                    ->required()
                    ->columns(4)
                    ->reactive(),
                
                TextInput::make('total_invoice')
                    ->label('Total Keseluruhan')
                    ->numeric()
                    //->disabled()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state, $get) {
                        // Ambil data dari repeater
                        $totalItems = $get('barang') ?? [];
                        
                        // Hitung total keseluruhan
                        $total = array_sum(array_column($totalItems, 'total'));
                        
                        // Set nilai total_invoice
                        $set('total_invoice', $total);
                    }),  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_invoice')->label('No Invoice'),
                Tables\Columns\TextColumn::make('esmdiid.nama')->label('Nama Perusahaan'),
                Tables\Columns\TextColumn::make('espelanggan.no_customer')->label('Nomor Telepon'),
                Tables\Columns\TextColumn::make('tanggal')->label('Tanggal')->date(),
                Tables\Columns\TextColumn::make('total_invoice')->label('Total Invoice')->money('idr'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),                
                Tables\Actions\Action::make('export')
                    ->label('PDF')
                    ->icon('heroicon-s-document-arrow-down')
                    ->openUrlInNewTab()
                    ->url(fn (Invoice $record) => route('invoice.export', $record->id)),
                Tables\Actions\Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->url(fn (Invoice $record) => route('invoice.preview', ['id' => $record->id])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
