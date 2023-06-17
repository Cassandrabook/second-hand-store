# Second-Hand Store

Wellcome to my second hand store created with PHP and phpMyAdmin.

## Installation

1.  Clone the github repo https://github.com/Cassandrabook/second-hand-store and use MAMP for mac och XAMPP for Windows for running apache and MySQL.
2.  Run the second-hand-store.sql file to set up the MySQL database.

## Usage

1. You can for example uese Postman to GET/POST/PUT/DELETE.
2. You can use four different endpoints in the browser or postman to GET the sellers and products.
3. You can show all the sellers and products, but you can also show on seller or on product based on the id.

localhost/second-hand-store/?action=
sellers --> to display all the sellers by alphabetical order
products --> to display all the products
seller&id=[id] --> to display on seller by it's id and show the products they have submitted to the store
product&id=[id] --> to display on product by it's id and display all the information about the product

# Postman PUT, POST, DELETE

## PUT

1. To update on product you have the endpont =update-product
2. To update on seller you have the endpont =update-seller
3. You have to have the full object send and change what you want to be updated
4. If a product has benn sold you can change between 0 and 1, 0 = not sold and 1 = sold

Use this in postman for update-product:
{
"id": ,
"name": "",
"size": "",
"price": "",
"seller_id": ,
"sold": ,
"submitted_date": ""
}

Use this in postman for update-seller:
{
"id": ,
"firstname": "",
"lastname": "",
"email": ""
}

localhost/second-hand-store/?action=update-product
localhost/second-hand-store/?action=update-seller

## POST

1. To add a product you have the endpont =add-product
2. To add a seller you have the endpont =add-seller
3. Here you don't have to write the id because it's auto_increment

Add product:
{
"name": "",
"size": "",
"price": 0,
"seller_id": 0,
"sold": 0
}

Add seller:
{
"fistname": "",
"lastname": "",
"email": ""
}

localhost/second-hand-store/?action=add-product
localhost/second-hand-store/?action=add-seller

## DELETE

1. To delete a product you have the endpont =delete-product
2. To delete a seller you have the endpont =delete-seller
3. Here you only have to write the id of the product/seller you want to delete

Delete:
{
"id": [id]
}
