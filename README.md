# kiwiquery

## Set up
1. Install main.php on your server
2. Edit the settings database settings to direct to your database
3. If you have a primary key identifier that is not named id, you can change it in the $key

## Usage
1. Set up an http request using the url where you placed the main.php file, for example
```
https://example.com/main.php
```
2. You must add a type, table, and columns parameter to the http request, for example 
```
https://example.com/main.php?type=select&table=dbtable&columns=column1,column2
```
3. For select types, the data will be returned in JSON format
4. For insert types, the SQL query string will be returned

## Types

### Select and Select ID

Get data from specified columns. Select will return all entries where as Select ID will return the specified entry according to the primary identifier key. Some examples:

#### 1. Select data from column1 and column2 from all entries in dbtable
```
https://example.com/main.php?type=select&table=dbtable&columns=column1,column2
```

#### 2. Select data from all columns from all entries in dbtable
```
https://example.com/main.php?type=select&table=dbtable&columns=*
```

#### 3. Select data from column1 and column2 from the entry at primary key identifier 1 in dbtable
```
https://example.com/main.php?type=selectid&table=dbtable&columns=column1,column2&id=1
```

#### 4. Select data from all columns from entry at primary key identifier 1 in dbtable
```
https://example.com/main.php?type=selectid&table=dbtable&columns=*&id=1
```

### Insert

Insert a new entry into the database table. Values must be listed in the order the columns they are inserting into are listed, for example value1,value2 if you have column1,column2

#### Add a new entry with value1 in column1 and value2 in column2 in the table dbtable
```
https://example.com/main.php?type=insert&table=dbtable&values=value1,value2&columns=column1,column2
```

### Update

Update requires the primary key identifier to be specified. This will update values for specified columns. You must list the new values in the same order as you list the columns for example newValue1,newValue2 if you have column1,column2

#### Update the entry at primary key identifier 1 with value1 in column1 and value2 in column2 in the table dbtable
```
https://example.com/main.php?type=update&table=dbtable&values=value1,value2&columns=column1,column2&id=1
```
### Delete ID

Delete a entry at a specified primary key identifier.

#### Delete the entry at primary key identifier 1 in the table dbtable
```
https://example.com/main.php?type=deleteid&table=dbtable&id=1
```

### Truncate

Empty the entire table clearing all current data.

#### Clear all the data from the table dbtable
```
https://example.com/main.php?type=truncate&table=dbtable
```
