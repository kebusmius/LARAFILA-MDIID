<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GstransaksiResource\Pages;
use App\Filament\Resources\GstransaksiResource\RelationManagers;
use App\Models\Gstransaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;


class GstransaksiResource extends Resource
{
    protected static ?string $model = Gstransaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Data GS';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nominal')
                    ->label('TAGIHAN'),
                Forms\Components\Select::make('gspelanggan_id')
                    ->relationship('gspelanggan', 'no_customer')
                    ->searchable()
                    ->label('NO TELEPON')
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('bulan')
                    ->label('BULAN')
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('gspelanggan.gsmdiid.no_account')
                    ->label('MDIID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gspelanggan.gsmdiid.nama')
                    ->searchable()
                    ->label('NAMA PELANGGAN'),
                Tables\Columns\TextColumn::make('gspelanggan.no_customer')
                    ->searchable()
                    ->label('NO PELANGGAN'),
                Tables\Columns\TextColumn::make('nominal')
                    ->searchable()
                    ->money('IDR')
                    ->formatStateUsing(function ($state) {
                        return 'Rp ' . number_format($state, 0, ',', '.');
                        })
                    ->label('NOMINAL')
                    ->summarize(Sum::make()->label('Total')->money('IDR')),
                Tables\Columns\TextColumn::make('gspelanggan.gsmdiid.pph')
                    ->searchable()
                    ->label('PPH'),
                Tables\Columns\TextColumn::make('bulan')
                    ->date()
                    ->label('BULAN')
                    ->searchable(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->label('Tanggal Awal'),
                        DatePicker::make('created_until')->label('Tanggal Akhir'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('bulan', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('bulan', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            // GsmdiidRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGstransaksis::route('/'),
            'create' => Pages\CreateGstransaksi::route('/create'),
            'edit' => Pages\EditGstransaksi::route('/{record}/edit'),
        ];
    }
}
