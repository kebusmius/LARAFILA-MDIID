<?php

namespace App\Filament\Resources;

use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use App\Filament\Resources\EstransaksiResource\Pages;
use App\Filament\Resources\EstransaksiResource\RelationManagers;
use App\Models\Estransaksi;
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
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SelectedArrayExport;
use App\Exports\SelectedDataExport;

class EstransaksiResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Estransaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Data ES';

    protected static ?string $navigationLabel = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nominal')
                    ->label('TAGIHAN'),
                Forms\Components\Select::make('espelanggan_id')
                    ->relationship('espelanggan', 'no_customer')
                    ->searchable()
                    ->label('NO TELEPON')
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('produk_id')
                    ->relationship('produk', 'nama')
                    ->searchable()
                    ->label('PRODUK')
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('bulan')
                    ->native(false),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('no')
                //     ->label('No')
                //     ->getStateUsing(fn ($rowLoop, $record) => $rowLoop->iteration),
                Tables\Columns\TextColumn::make('espelanggan.esmdiid.no_account')
                    ->label('NO MDIID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('espelanggan.esmdiid.nama')
                    ->searchable()
                    ->label('NAMA PELANGGAN'),
                Tables\Columns\TextColumn::make('espelanggan.no_customer')
                    ->searchable()
                    ->label('NO TELEPON'),
                Tables\Columns\TextColumn::make('nominal')
                    ->money('IDR')
                    ->formatStateUsing(function ($state) {
                        return 'Rp ' . number_format($state, 0, ',', '.');
                        })
                    ->searchable()
                    ->label('NOMINAL')
                    ->summarize(Sum::make()),
                Tables\Columns\TextColumn::make('produk.nama')
                    ->searchable()
                    ->label('PRODUK'),
                Tables\Columns\TextColumn::make('espelanggan.esmdiid.pph')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '-' => 'gray',                    
                        'YES' => 'success',
                        'NO' => 'danger',
                    })
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
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('export')
                    ->label('Export Selected')
                    ->color('success')
                    ->action(function (Collection $records) {
                        return Excel::download(new SelectedDataExport($records), 'selected-records-' . date('Y-m-d') . '.xlsx');
                    })
                    ->requiresConfirmation() // Konfirmasi sebelum export (opsional)
                        ->icon('heroicon-s-arrow-down-tray'),
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
            'index' => Pages\ListEstransaksis::route('/'),
            'create' => Pages\CreateEstransaksi::route('/create'),
            'edit' => Pages\EditEstransaksi::route('/{record}/edit'),
            'view' => Pages\ViewEstransaksi::route('/{record}'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            
        ];
    }
}
