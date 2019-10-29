# freshdesk-webhook


    
**简要描述：** 

-  接收webhook数据的接口
- 基于yii2,编写的

**请求方式：**
- POST 

**参数：** 

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|json数组 |是  |string |{xxx:yyyy}   |

 **返回示例**
``` 
{
    "error_code": 0,
    "message": "Success!",
    "data": 1
}
```
 

 **返回参数说明** 

 |参数|类型|描述|
|:-------|:-------|:-------|
| error_code | number| 无 |
| message | string| 无 |
| - data |object  | 无 |


