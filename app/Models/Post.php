<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;

	// // Permitir asignación masiva (ajusta según tu esquema)
	// protected $guarded = [];

	// protected $fillable = [
	// 	// ...existing fillable fields...
	// 	'user_id',
	// ];


//        public function posts() 
//     {
//         return $this->hasMany(Post::class);
//     }


//   public function user()
//     {
//         return $this->belongsTo(User::class);
//     }


protected $fillable=[
    'titulo',
    'descripcion',
    'imagen',
    'ser_id'
];



public function user(){
	return $this->belongsTo(User::class)->select(['name','username']);
}

public function comentarios(){
	return $this->hasMany(Comentario::class);
}

public function likes(){
	return $this->hasMany(Like::class);
}

public function checkLike(){
	return $this->likes->contains('user_id', $user->id);
}

 // Almacena los seguidores de un usuario
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    // Almacenar los que seguimos
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }


    // Comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user)
    {
        return $this->followers->contains( $user->id );
    }
}
