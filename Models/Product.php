<?php
class Product{
    public $id;
    public $title;
    public $price;
    public $stockLevel;
    public $categoryName;

};

// $prod = new Product(1,'Chai',18,39,'Beverages');
// $prod->title = "Stefan";
// echo $prod->title;
// a = new Product(1,'Chai',18,39,'Beverages');
// a.title = "Stefan"
// console,log(a.title)


#$allaNamn2 = Array("Stefan","Kalle","Olle")
// arr = ["Stefan","Kalle","Olle"]
// arr.forEach(function(name){console.log(name)})
// for(let name of arr){
//     console.log(name)    

// ta bort helt och hållet

// SEEDNING
// SELECT COUNT(*) FROM Products
// INSERT INTO PRODUCTS (title, price, stockLevel, categoryName) VALUES ('Chai',18,39,'Beverages')



$allaProdukter = [
new Product(1,'Chai',18,39,'Beverages'),
new Product(2,'Chang',19,17,'Beverages'),
new Product(3,'Aniseed Syrup',10,13,'Condiments'),
new Product(4,'Chef Antons Cajun Seasoning',22,53,'Condiments'),
new Product(5,'Chef Antons Gumbo Mix',21,0,'Condiments'),
new Product(6,'Grandmas Boysenberry Spread',25,120,'Condiments'),
new Product(7,'Uncle Bobs Organic Dried Pears',30,15,'Produce'),
new Product(8,'Northwoods Cranberry Sauce',40,6,'Condiments'),
new Product(9,'Mishi Kobe Niku',97,29,'Meat/Poultry'),
new Product(10,'Ikura',31,31,'Seafood'),
new Product(11,'Queso Cabrales',21,22,'Dairy Products'),
new Product(12,'Queso Manchego La Pastora',38,86,'Dairy Products'),
new Product(13,'Konbu',6,24,'Seafood'),
new Product(14,'Tofu',22,35,'Produce'),
new Product(15,'Genen Shouyu',18,39,'Condiments'),
new Product(16,'Pavlova',12,29,'Confections'),
new Product(17,'Alice Mutton',39,0,'Meat/Poultry'),
new Product(18,'Carnarvon Tigers',231,42,'Seafood'),
new Product(19,'Teatime Chocolate Biscuits',213,25,'Confections'),
new Product(20,'Sir Rodneys Marmalade',81,40,'Confections'),
new Product(21,'Sir Rodneys Scones',10,3,'Confections'),
new Product(22,'Gustafs Knäckebröd',21,104,'Grains/Cereals'),
new Product(23,'Tunnbröd',9,61,'Grains/Cereals'),
new Product(24,'Guaraná Fantástica',231,20,'Beverages'),
new Product(25,'NuNuCa Nuß-Nougat-Creme',14,76,'Confections'),
new Product(26,'Gumbär Gummibärchen',312,15,'Confections'),
new Product(27,'Schoggi Schokolade',213,49,'Confections'),
new Product(28,'Rössle Sauerkraut',132,26,'Produce'),
new Product(29,'Thüringer Rostbratwurst',231,0,'Meat/Poultry'),
new Product(30,'Nord-Ost Matjeshering',321,10,'Seafood'),
new Product(31,'Gorgonzola Telino',321,0,'Dairy Products'),
new Product(32,'Mascarpone Fabioli',32,9,'Dairy Products'),
new Product(33,'Geitost',12,112,'Dairy Products'),
new Product(34,'Sasquatch Ale',14,111,'Beverages'),
new Product(35,'Steeleye Stout',18,20,'Beverages'),
new Product(36,'Inlagd Sill',19,112,'Seafood'),
new Product(37,'Gravad lax',26,11,'Seafood'),
new Product(38,'Côte de Blaye',1,17,'Beverages'),
new Product(39,'Chartreuse verte',18,69,'Beverages'),
new Product(40,'Boston Crab Meat',2,123,'Seafood'),
new Product(41,'Jacks New England Clam Chowder',2,85,'Seafood'),
new Product(42,'Singaporean Hokkien Fried Mee',14,26,'Grains/Cereals'),
new Product(43,'Ipoh Coffee',46,17,'Beverages'),
new Product(44,'Gula Malacca',2,27,'Condiments'),
new Product(45,'Rogede sild',3,5,'Seafood'),
new Product(46,'Spegesild',12,95,'Seafood'),
new Product(47,'Zaanse koeken',4,36,'Confections'),
new Product(48,'Chocolade',6,15,'Confections'),
new Product(49,'Maxilaku',5,10,'Confections'),
new Product(50,'Valkoinen suklaa',1,65,'Confections'),
new Product(51,'Manjimup Dried Apples',53,20,'Produce'),
new Product(52,'Filo Mix',7,38,'Grains/Cereals'),
new Product(53,'Perth Pasties',4,0,'Meat/Poultry'),
new Product(54,'Tourtière',7,21,'Meat/Poultry'),
new Product(55,'Pâté chinois',24,115,'Meat/Poultry'),
new Product(56,'Gnocchi di nonna Alice',38,21,'Grains/Cereals'),
new Product(57,'Ravioli Angelo',7,36,'Grains/Cereals'),
new Product(58,'Escargots de Bourgogne',7,62,'Seafood'),
new Product(59,'Raclette Courdavault',55,79,'Dairy Products'),
new Product(60,'Camembert Pierrot',34,19,'Dairy Products'),
new Product(61,'Sirop dérable',7,113,'Condiments'),
new Product(62,'Tarte au sucre',7,17,'Confections'),
new Product(63,'Vegie-spread',7,24,'Condiments'),
new Product(64,'Wimmers gute Semmelknödel',7,22,'Grains/Cereals'),
new Product(65,'Louisiana Fiery Hot Pepper Sauce',7,76,'Condiments'),
new Product(66,'Louisiana Hot Spiced Okra',17,4,'Condiments'),
new Product(67,'Laughing Lumberjack Lager',14,52,'Beverages'),
new Product(68,'Scottish Longbreads',8,6,'Confections'),
new Product(69,'Gudbrandsdalsost',8,26,'Dairy Products'),
new Product(70,'Outback Lager',15,15,'Beverages'),
new Product(71,'Flotemysost',8,26,'Dairy Products'),
new Product(72,'Mozzarella di Giovanni',8,14,'Dairy Products'),
new Product(73,'Röd Kaviar',15,101,'Seafood'),
new Product(74,'Longlife Tofu',10,4,'Produce'),
new Product(75,'Rhönbräu Klosterbier',9,125,'Beverages'),
new Product(76,'Lakkalikööri',9,57,'Beverages'),
new Product(77,'Original Frankfurter grüne Soße',13,32,'Condiments'),
];


function getProduct($id){    //function getProduct(int $id): Product | null{
    // SELECT * FROM PRODUCTS WHERE ID = $id
    global $allaProdukter;

    // return array_find($allaProdukter, function ($product) use ($id ) {
    //     return $product->id == $id;
    // });

    foreach($allaProdukter as $product){
        if($product->id == $id){
            return $product;
        }
    }
    return null;
}

// JAG SA: Arrayer = "lika" som  i JavaScript
// MAP = transformera varje element i en array till något annat
// FILTER = filtrera bort element i en array - MÅNGA
// FIND = - sök FÖRSTA elementet i en array som matchar




function getAllCategories(){
    // SELECT DISTINCT categoryName FROM Products
// $data = $pdo->query('SELECT age FROM users')->fetchAll(PDO::FETCH_COLUMN);
/* array (
  0 => 'John',
  1 => 'Mike',
  2 => 'Mary',
  3 => 'Kathy',
)*/
    //global $allaProdukter;
    // $cats = array_map(function($product):string {return $product->categoryName;},$allaProdukter);
    // $cats = array_unique($cats);
//    cats är en array med alla produkters kategorier
    // $cats = [];
    // foreach(getAllProducts() as $product){    // en produklt i taget
    //     if(!in_array($product->categoryName,$cats)){ // finns denna produktens kategori i cats?
    //         $cats[] = $product->categoryName;     // om inte - lägg till
    //     }
    // }

    // getAllProducts()  "SSK", "Modo", "SSK", "DIF"
    // $lagen = [];
    // foreach(getAllProducts() as $lag){   // $lag = "Modo"
    //     // ! = not
    //     // if lag INTE in array
    //     if(!in_array($lag,$lagen)){
    //         array_push($lagen, $lag);   // $lagen=["SSK", "Modo", "DIF"]
    //     }
    // }






    $cats = [];
    foreach(getAllProducts() as $product){
        if(!in_array($product->categoryName,$cats)){
            array_push($cats, $product->categoryName);
        }
    }

    //var_dump($cats);
    return $cats;
}

function getAllProducts(){
    // $dsn = "mysql:host=localhost;dbname=stefansshop";
    // $pdo = new PDO($dsn, "root", "hejsan123");
    // $query = $pdo->query('SELECT * FROM Products');
    // //                                  DETTA ÄR TABELLEN

    // return $query->fetchAll(PDO::FETCH_CLASS, 'Product');
    // //                                         DETTA ÄR PHP KLASS 
//    DETTA SKA BLI EN SELECT * FROM Products
    global $allaProdukter;
    return $allaProdukter;
}
?>