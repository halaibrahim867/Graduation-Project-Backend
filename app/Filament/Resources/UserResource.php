<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Department;
use App\Models\User;
use App\Policies\RolePolicy;
use BezhanSalleh\FilamentShield\Resources\RoleResource;
use Doctrine\DBAL\Types\TextType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name'),
                Forms\Components\TextInput::make('last_name'),
                Forms\Components\TextInput::make('email')
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->required()
                    ->password()
                    ->revealable()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image'),
                Forms\Components\Radio::make('is_doctor')
                    ->options([
                        '0'=>'Not Doctor',
                        '1'=>'Doctor'
                    ]),
                Forms\Components\Select::make('department_id')
                    ->label('Department Name')
                    ->options(Department::all()->pluck('name','id'))
                    ->searchable(),
                Forms\Components\Select::make('role_id')
                    ->label('Role Name')
                    ->options(Role::all()->pluck('name','id'))
                    ->searchable(),
                Forms\Components\TextInput::make('phone')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('is_doctor'),
                Tables\Columns\TextColumn::make('department.name')
                    ->url(fn (User $record) => DepartmentResource::getUrl('edit',['record'=>$record->department]))
                    ->label('Department Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->url(fn(User $record)=>RoleResource::getUrl('index',['record'=>$record->name]))
                    ->label('Role Name'),
                Tables\Columns\TextColumn::make('phone')
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
