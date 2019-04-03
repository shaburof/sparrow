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

delete
$footable->delete()->query(function($q){
    $q->where('id','=','12');
});


select
$footable = Builder::sCreate(\App\Model\footable::class);
    $footable->select()->query(function($q){    // or select('id'), select(['id','name'])
        $q->where('name','=','nata');
    })->all();

или 

$footable->select()->all()  // ->select('title') только поле 'title'

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
