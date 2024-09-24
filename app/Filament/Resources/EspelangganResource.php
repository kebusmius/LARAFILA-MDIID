<?php

namespace App\Filament\Resources;

use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use App\Filament\Resources\EspelangganResource\Pages;
use App\Filament\Resources\EspelangganResource\RelationManagers;
use App\Models\Espelanggan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SelectedArrayExport;

class EspelangganResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Espelanggan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Data ES';

    protected static ?string $navigationLabel = 'Pelanggan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_customer')
                    ->label('NO TELEPON')
                    ->unique('espelanggans', 'no_customer') // Cek di tabel 'espelanggans' untuk kolom 'no_customer'
                    ->rule('unique:espelanggans,no_customer') // Aturan validasi tambahan untuk memastikan no_customer unik
                    ->placeholder('Masukkan nomor telepon pelanggan')
                    ->maxLength(15),
                Forms\Components\Select::make('esmdiid_id')
                    ->relationship('esmdiid', 'nama')
                    ->searchable()
                    ->label('NO MDIID')
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('no')
                //     ->label('No')
                //     ->getStateUsing(fn ($rowLoop, $record) => $rowLoop->iteration),
                Tables\Columns\TextColumn::make('esmdiid.no_account')
                    ->searchable()
                    ->label('NO MDIID'),
                Tables\Columns\TextColumn::make('esmdiid.nama')
                    ->searchable()
                    ->label('NAMA PERUSAHAAN'),
                Tables\Columns\TextColumn::make('no_customer')
                    ->label('NO TELEPON')
                    ->searchable()
            ])
            ->filters([
                //
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
                        // Konversi collection ke array
                        $recordsArray = $records->map(function ($record) {

                        $esmdiid = $record->esmdiid; // Asumsikan relasi 'esmdiid' ada

                            return [
                                $esmdiid ? $esmdiid->no_account : 'N/A',
                                $esmdiid ? $esmdiid->nama : 'N/A', // Ambil data dari relasi
                                $record->no_customer,
                            ];
                        })->toArray();

                        // Buat instance ekspor dengan data terpilih
                        return Excel::download(new SelectedArrayExport($recordsArray), 'selected-records-' . date('Y-m-d') . '.xlsx');
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
            'index' => Pages\ListEspelanggans::route('/'),
            'create' => Pages\CreateEspelanggan::route('/create'),
            'edit' => Pages\EditEspelanggan::route('/{record}/edit'),
            'view' => Pages\ViewEspelanggan::route('/{record}'),
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
