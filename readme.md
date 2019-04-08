insert
$footable = Builder::sCreate(\App\Model\footable::class);
$footable->insert([
    'title' => 'foo',
    'description' => 'bar',
    'name' => 'Ola Ivanova'
]);

updated
$footable = Builder::sCreate(\App\Model\footable::class);

$footable->update([
    'title'=>'edited'
])->query(function($q){
    $q->where('id','=','23')->or()->where('name','like','kola');
});

$footable->find(1);         //find
$footable->update([
    'title'=>'edited'
]);                         // update

$footable->select()->query(function ($q) {
        $q->where('id', '=', 26);
    })->first();                               // find
$footable->update([
    'title'=>'edited'
]);                                            // update

delete
$footable->delete()->query(function($q){
    $q->where('id','=','12');
});

$footable->find(28);    // find
$footable->delete();    //delete

$footable->select()->query(function ($q) {
        $q->where('id', '=', 26);
    })->first();                             // find
$footable->delete();                         // delete


select
$footable = Builder::sCreate(\App\Model\footable::class);
    $footable->select()->query(function($q){    // or select('id'), select(['id','name'])
        $q->where('name','=','nata');
    })->all();

или 

$footable->select()->all()  // ->select('title') только поле 'title'

или

find
$footable = \Vendor\Sparrow\Core\Builder::sCreate(\App\Model\footable::class);
$data = $footable->find(1);    // select from footable where Id is 1


created_at and updated_at
if the table contains created_at and updated_at fields, they will be updated when inserting and updating


raw query
\Vendor\Sparrow\Core\DB\DB::sraw(['select * from footable'])->all();

->all()     все записи
->first()   первая
->last()    последняя
 

создать класс
$footable = Builder::sCreate(\App\Model\footable::class);

сохранить в хранилище классов
$footable = Builder::sCreate(\App\Model\footable::class);
setClass($footable);

получить класс из хранилища
getClass(\App\Model\footable::class)


получаем данные от request
request()->option


render view file:
 render('welcome', ['title' => '<b>wel</b>come']);
 for render use blade engine


Routing

Route::get('/','UserController@main',['name'=>'main']);

Route::get('/user/?/?',function($a,$b){
    var_dump("$a and $b");
},['name'=>'closure']);

Route::get('/user/?','UserController@user',['name'=>'user']);   // for get request
Route::get('/user/?','Abc.UserController@user',['name'=>'user']);   // for get request for /App/Controllers/Abc/UserController.php controller path
Route::post('/user/?','UserController@user',['name'=>'user']);  //for post request

get full url woth parameters
url('foo',['id'=>123]) // return http[s]://domain.name/foo&id=15

get route full path by name with parameters
router('index',['foo'=>'bar'])

get full path by action with parameters
action('UserController@user',['foo'=>'bar'])

csrf
csrf()  // get csrf token
{!! csrf_field() !!}    // get csrf field in HTML form

session

session()->foo='bar'    //store in session
echo session()->foo     // get value from session

session()->remove('foo')    //unset from session

session()->frameworkSession()->someVariable = 'value';  // добавить в массив сессий 'sparrow'.env('key')
echo session()->frameworkSession()->someVariable;


env
env('foo','default')  // get from .env file foo parameter or get 'default' if 'foo' is missing


console commands:
php sparrow.php help
php sparrow.php come:command -p -d

DateTime
now()   // return current date and time
now('date') or now('time')  // only date or time
