$footable = new \App\Model\footable();

select

// SELECT * FROM footable  WHERE id = ?
	$data = $footable->find(31)->first();


// SELECT * FROM footable
	$data = $footable->select()->all();	
	$data = $footable->select()->first();
	$data = $footable->select()->last();


// SELECT id,name FROM footable  WHERE id > ?
	$date = $footable->select(['id','name'])->where('id','>', '31')->all();	


// SELECT * FROM footable  WHERE name = ? OR  name = ?
    $data = $footable->select()->where(function ($query) {				
        $query->where('name', '=', 'one name')->or()->where('name', '=', 'two name');
    })->all();


// SELECT * FROM footable  WHERE id = ?;   'id' lowercase in table
	$footable->select()->where(98)->first()

insert

// INSERT INTO footable (title,description,name) VALUES (?,?,?);
	$id = $footable->insert([
        	'title' => 'foo',
        	'description' => 'bar',
        	'name' => 'Ola Ivanova'
        ]);


	// return id - if there is an autoincrement field in the table, the value of the last record will return, or null if autoincrement field missing

	$footable->title = 'Create new title';
	$footable->description = 'Create new description';
        $footable->name = 'Kale Falanso';
	$footable->model2 = 'some model';

        $id = $footable->save();
	// return id - if there is an autoincrement field in the table


update

// UPDATE footable SET title = ? WHERE id = ?;
	$footable->update(['title' => 'fooBar'])->where('id','=','31')->execute();


//UPDATE footable SET title = ? WHERE id = ? OR  id = ?;
	$footable->update(['title' => 'fooBarBaz'])->where(function ($query) {
	     $query->where('id', '=', '31')->or()->where('id', '=', '32');
	})->execute();

->execute() // return boolean status of operation


// UPDATE footable SET title = ?,updated_at = ?  WHERE id = ? AND  name = ?;
	    $footable->where(function($query){
        	$query->where('id','=',98)->and()->where('name','=','Ola Ivanova');
	    })->update(['title'=>'new title 2'])->execute();

// UPDATE footable SET title = ?,updated_at = ?   WHERE id = ?;
	$footable->find(98)->update(['title'=>'new title'])->execute();


    $f = $footable->select()->where('model2', 'like', '%some%')->all();
    foreach ($f as $value) {
        $value->name = 'changed';
        $value->save();
    }



delete

// DELETE FROM footable  WHERE id = ?;
	$footable->delete()->where('id','=',99)->execute()

// DELETE FROM footable  WHERE id = ?'
	$footable->find(31)->delete()->execute();

// DELETE FROM footable  WHERE id = ?;
	$footable->select()->where(32)->delete()->execute();

// DELETE FROM footable  WHERE id = ? OR  id = ?;
	$footable->select()->where(function($query){
        	$query->where('id','=',31)->or()->where('id','=',32);
	})->delete()->execute();

// DELETE FROM footable   WHERE id = ? OR  id = ?;
	$footable->where(function($query){
        	$query->where('id','=',33)->or()->where('id','=',34);
        })->delete()->execute();

// delete all fields where 'model2' = 'abc'
    $f = $footable->select()->where('model2', '=', 'abc')->all();
    foreach ($f as $value) {
        $value->delete()->execute();
    }


created_at and updated_at
if the table contains created_at and updated_at fields, they will be updated when inserting and updating


raw query
\Vendor\Sparrow\Core\DB\DB::sraw(['select * from footable'])->all();

->all()     все записи
->first()   первая
->last()    последняя
 

создать класс
$footable = Builder::sCreate(\App\Model\footable::class);

store Class in storage

//store class URL
setClass(new \Vendor\Sparrow\Core\Url());

//store class with 'connector' name
setClass(\Vendor\Sparrow\Core\DBConnectors\BaseConnector::getDBConnentor(),'connector');


//get from storage
getClass(\Vendor\Sparrow\Core\Url::class)

// get class with 'connector' name
getClass('connector')


получаем данные от request
request()->option


render view file:
 render('welcome', ['title' => '<b>wel</b>come']);
 for render use blade engine


Routing

Route::get('/','UserController@main',['name'=>'main']);

Route::get('/test/?/?','userController@user');
in userController in user() method:
public function user($firstValue,$secondValue)
    {
        return render('test',compact('firstValue','secondValue'));
    }
    
    

Route::get('/user/?/?',function($a,$b){
    var_dump("$a and $b");
},['name'=>'closure']);

Route::get('/user/?','UserController@user',['name'=>'user']);   // for get request
Route::get('/user/?','Abc.UserController@user',['name'=>'user']);   // for get request for /App/Controllers/Abc/UserController.php controller path
Route::post('/user/?','UserController@user',['name'=>'user']);  //for post request

get full url with parameters
url('foo',['id'=>123]) // return http[s]://domain.name/foo&id=15

get route full path by name with parameters
router('index',['foo','bar'])    // return url with the replacement of characters questioned on the values ​​in the array

get full path by action with parameters
action('UserController@user',['foo','bar'])   // return url with the replacement of characters questioned on the values ​​in the array

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

JSON

// to json format
JSON(['foo'=>'bar'])	

// from json format to array
fromJSON('{"foo":"bar"}');
