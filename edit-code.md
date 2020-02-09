## TEST UBUNU18

```
sudo apt update

sudo apt-get install php7.2 php7.2-cli php7.2-common php7.2-json php7.2-opcache php7.2-mysql php7.2-mbstring php7.2-zip php7.2-fpm  php7.2-xml


*visual studio code
*git
*node.js


cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
composer

composer global require laravel/installer
sudo chown -R oshimamasara /home/oshimamasara/.composer
composer global require laravel/installer
laravel new blog

vi ~/.bash_profile
  export PATH=~/.composer/vendor/bin:$PATH
source ~/.bash_profile

laravel new blog
cd blog
php artisan serve
```


## Check Version & Install

```
php --version

composer --version

node.js
    sudo apt istall node

npm --version
    sudo apt install npm

mysql --version
    curl -OL https://dev.mysql.com/get/mysql-apt-config_0.8.14-1_all.deb
    sudo dpkg -i mysql-apt-config*
    sudo apt update
    sudo apt install mysql-server -y
      --> OK button
      --> select-- Use Strong Password Encrypto(Recommented)
    sudo systemctl status mysql.service
    mysql -u root -p

yarn --version
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
    sudo apt-get update && sudo apt-get install yarn
```

## Laravel App

```
  laravel new todo
  cd todo
  php artisan --version
  php artisan serve
```

## [Bootstrap](https://laravel.com/docs/6.x/frontend)

```
command -->
    composer require laravel/ui --dev
    php artisan ui bootstrap
    npm install && npm run dev

◎check files
      public/css/app.css
      public/js/app.js
```


## Database Standby

```
◎checkfile    .env

  mysql -u root -p
  show databases;
  create database db_todo_01;
  show databases;

  SHOW GLOBAL VARIABLES LIKE 'PORT';
    使用中のポート確認
  exit

  edit .env
  php artisan migrate
```

Database Migrate

```
php artisan migrate

php artisan make:model Todo --migration
    ●edit --->  database/migrations/xxxxxx_create_contacts_table
```

```
public function up()
{
    Schema::create('todos', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps();
        $table->string('title');
        $table->string('memo');        
    });
}
```

```
php artisan migrate

  Check してもとくにないよ
  mysql -u root -p
  show databases;
  use データベース名;
  show tables;
  select * from テーブル名;
  exit
```

●edit --->   app/Todo.php

```
class Todo extends Model
{
    protected $fillable = [
        'title',
        'memo'      
        ];
}
```


## Controller
  
```
php artisan make:controller TodoController --resource
  
◎check CURD
    app/Http/Controllers/TodoController.php
```

## Route
  ●edit ---> routes/web.php

```
Route::resource('todo', 'TodoController');
```


## Save Data
●edit --->  app/Http/Controllers/TodoController.php

```
use App\Todo;


public function store(Request $request)
{
    $request->validate([
        'title'=>'required'
    ]);

    $todo = new Todo([
        'title' => $request->get('title'),
        'memo' => $request->get('memo')
    ]);
    $todo->save();
    return redirect('/todo')->with('success', 'todo saved!');
}


public function create()
{
    return view('todos.create');
}
```

## Edit HTML File
  ●edit --->  resources/views/base.blade.php
  
```
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lravel Todo</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="container">
      @yield('main')
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  </body>
</html>
```


●edit  --->  resources/views/todos/create.blade.php

```
@extends('base')

@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Todo 追加</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('todos.store') }}">
          @csrf
          <div class="form-group">    
              <label for="title">タイトル:</label>
              <input type="text" class="form-control" name="title"/>
          </div>

          <div class="form-group">
              <label for="memo">メモ:</label>
              <input type="text" class="form-control" name="memo"/>
          </div>

          <button type="submit" class="btn btn-primary">追加</button>
      </form>
  </div>
</div>
</div>
@endsection
```

●edit --->  app/Http/Controllers/TodoController.php

```
public function index()
{
    $todos = Todo::all();

    return view('todos.index', compact('todos'));
}
```


●edit  --->  resources/views/todos/index.blade.php

```
@extends('base')

@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Todoリスト</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>タイトル</td>
          <td>メモ</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($todos as $todo)
        <tr>
            <td>{{$todo-> id}}</td>
            <td>{{$todo-> title}}</td>
            <td>{{$todo-> memo}}</td>
            <td>
                <a href="{{ route('todos.edit',$todo->id)}}" class="btn btn-primary">編集</a>
            </td>
            <td>
                <form action="{{ route('todos.destroy', $todo->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">完了</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection
```


●edit --->  app/Http/Controllers/TodoController.php

```
public function edit($id)
{
    $todo = Todo::find($id);
    return view('todos.edit', compact('todo'));        
}
```

```
public function update(Request $request, $id)
{
    $request->validate([
        'title'=>'required'
    ]);

    $todo = Contact::find($id);
    $todo->title =  $request->get('title');
    $todo->memo = $request->get('memo');
    $todo->save();

    return redirect('/todos')->with('success', 'Todo 更新完了');
}
```

●edit  --->  resources/views/todos/edit.blade.php
```
@extends('base')
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Todo 内容変更</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br />
        @endif
        <form method="post" action="{{ route('todos.update', $todo->id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="title">Todo:</label>
                <input type="text" class="form-control" name="title" value={{ $todo->title }} />
            </div>
            <div class="form-group">
                <label for="memo">メモ:</label>
                <input type="text" class="form-control" name="memo" value={{ $todo->memo }} />
            </div>

            <button type="submit" class="btn btn-primary">変更</button>
        </form>
    </div>
</div>
@endsection
```


●edit --->  app/Http/Controllers/TodoController.php

```
public function destroy($id)
{
    $todo = Todo::find($id);
    $todo->delete();

    return redirect('/todos')->with('success', 'Todo １つ完了');
}
```

●edit   --->  resources/views/todos/index.blade.php

```
<div class="col-sm-12">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>

<hr>
<div>
 <a style="margin: 15px;" href="{{ route('todos.create')}}" class="btn btn-primary">Todo追加</a>
</div>  
<hr>
```

●edit   --->  resources/views/todos/index.blade.php

```
<a href="{{route('todos.show', $todo->id}}">{{$todo-> title}}</a>
```

●top page list sort   edit --->  app/Http/Controllers/TodoController.php

```
$todos = Todo::orderBy('id','desc')->get();
```
