Apidemia - Workshop - Blog Module
- - - 

# File structure
Folder listing:
 * `docs` - documentation folder
 * `data` - sql exports, optional dummy data
  
 
# Data definition
Entity definitions

| Name | Format | Index |
| --- | --- | --- |
 | id | `INT`(11) | PK |
 | title | `VARCHAR(255)` | |
 | slug | `VARCHAR(150)` | unique |
 | content | `TEXT` | |
 | userId | `INT(11)` | INDEX, FK, user.id |
 | publishDate | `TIMESTAMP` | | 
 
