Apidemia - Workshop - Message Module
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
 | senderId | `INT(11)` | INDEX |
 | receiverId | `INT(11)` | INDEX |
 | content | `TEXT` | |
 | dateSent | `TIMESTAMP` ||
 | isSeen | `TINYINT(4)` | DEFAULT 0 | 
 
