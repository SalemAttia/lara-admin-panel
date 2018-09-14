

# LoginWithEmail
POST : http://159.203.131.31/api/v1/LoginWithEmail<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "email" : "required",
    "password" : "requried",
}
```
```
response:{
           "status": true,
           "data": {
             "full_name": "Abdel Aziz hassan",
             "email": "sdsdsdsd@gmail.com",
             "token": "lkM0QLTT6TicI6SmF0qfYFxgOacPIFYjxgYLAFtf",
             "mobile": "0100482834"
           },
           "error": ""
}
```
 



# LoginWithFacebook
POST : http://159.203.131.31/api/v1/LoginWithFacebook<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "facebookToken" : "required"
}
```
```
response:{
             "status": true,
             "data": {
                 "id": 10,
                 "full_name": "HuneySaber",
                 "email": "huney_saber@hotmail.com",
                 "token": "h0woM9tJSrvvoXpPuKIp9sB9W4J6lSdwc4YibO7s",
                 "mobile": null
             },
             "error": ""
}
```



# Register
POST : http://159.203.131.31/api/v1/Register<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "email" : "required",
    "password" : "requried",
    "mobile" : "requried",
    "full_name" : "requried",
}
```
```
response:{
           "status": true,
           "data": {
             "full_name": "Abdel Aziz hassan",
             "email": "sdsdsdsd@gmail.com",
             "token": "lkM0QLTT6TicI6SmF0qfYFxgOacPIFYjxgYLAFtf",
             "mobile": "0100482834"
           },
           "error": ""
}
```


# ForgetPassword
POST : http://159.203.131.31/api/v1/ForgetPassword<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "email" : "required"
}
```
```
response:{
           "status": true,
           "data": "An email has been sent to your email to create new password check the inbox folder",
           "error": ""
}
```


 # getBrands
POST : http://159.203.131.31/api/v1/getBrands<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)",
    "limit" : "Optional By default will return 20 Brand  in once you can change this By Send naother limit",
    "offset" : "Optional will select start point from database like give me from id 10"
}
```
```
response:{
  "status":true,
  "data":[
         {
            "id" :1,
            "name":"بي ام دبيو","
            image":"http://159.203.131.31/files/30573_1496663695.png",
            "slug":"bmw"
         }
  ],
  "error":""
}
```


 # getSliders
POST : http://159.203.131.31/api/v1/getSliders<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)"
}
```
```
response:{
  "status":true,
  "data":[
         {
            "id" :1,
            "title":"","
            image":"http://159.203.131.31/files/30573_1496663695.png",
            "link":""
         }
  ],
  "error":""
}
```

 # getBrandModel  
POST : http://159.203.131.31/api/v1/getBrandModel<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)",
    "brand_id" : "Optional this will select brand model depend on brand id",
    "limit" : "Optional By default will return 20 Brand Model in once you can change this By Send naother limit",
    "offset" : "Optional will select start point from database like give me from id 10"
}
```
```
response:{
  "status":true,
  "data":[
         {
            "id" :1,
            "name":"bmw jeeb","
            image":"http://159.203.131.31/files/30573_1496663695.png",
            "slug":"bmw_jeeb",
            "brand" : {
                  "id" :1,
                  "name":"بي ام دبيو","
                  image":"http://159.203.131.31/files/30573_1496663695.png",
                  "slug":"bmw"
            }
         }
  ],
  "error":""
}
```



 # getColors
POST : http://159.203.131.31/api/v1/getColors<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)"
}
```
```
response:{
  "status":true,
  "data":[
         {
            "id" :1,
            "name":"Black","
            code":"#000000",
            "slug":"black"
         }
  ],
  "error":""
}
```


 # getSpecs
POST : http://159.203.131.31/api/v1/getSpecs<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)"
}
```
```
response:{
  "status":true,
  "data":[
         {
            "id" :1,
            "name":"Air Condtion","
            icon":"http://159.203.131.31/files/84746_1496734566.png",
            "slug":"airـcondition"
         }
  ],
  "error":""
}
```


 # getAds
POST : http://159.203.131.31/api/v1/getAds<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)"
}
```
```
response:{
  "status":true,
  "data":[
         {
            "id" :1,
            image":"http://159.203.131.31/files/84746_1496734566.png",
            "action":"http://159.203.131.31"
         }
  ],
  "error":""
}
```


 # getCars  
POST : http://159.203.131.31/api/v1/getCars<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)",
    "brand_id" : "Optionl if you pass it will select cars depend on brand_id",
    "brand_model_id" : "Optionl value('brand_model_id' , 'text') if you choose type new make sure you put id of brand model or if type empty pass text for searching",
    "to" : "Optionl will select cars less than this price",
    "form" : "Optionl will select cars form and highter than this price",
    "limit" : "Optional By default will return 20 Brand Model in once you can change this By Send naother limit",
    "offset" : "Optional will select start point from database like give me from id 10",
    "status" : "Optional get cars with one status only value(pending , accepted , reject)",
    "user_id" : "Optionl value('user_id' , 'customer_id') if you choose type new  pass user_id the admin who add the car  , if type pass empty make sure you return with customer id"  ,
    "name" : "Optional it for search by car name",
    "type" : "Optional value("new " , "") if you put new will get new cars wich add by admin , if not have value will search for userd car wich add by customers "
}
```
```
response:{
             "status": true,
             "data": [
               {
                 "id": 1,
                 "price": 200000,
                 "name": "d128 fiat",
                 "phone": "01080482833",
                 "year": 1980,
                 "description": "1000cc\r\nnosd\r\ntrst",
                 "status": "Pending",
                 "image": [
                   "http://159.203.131.31/files/19019_1497350631.jpg",
                   "http://159.203.131.31/files/73805_1497350631.jpg"
                 ],
                 "slug": "Fait_128",
                 "brandModel": "Fait 128",
                 "specs": [
                   {
                     "id": 2,
                     "name": "فتحة سقف",
                     "icon": "http://159.203.131.31/files/68788_1496734802.png",
                     "slug": "sunـroof",
                     "value": "Test 10"
                   },
                   {
                     "id": 1,
                     "name": "تكيف",
                     "icon": "http://159.203.131.31/files/84746_1496734566.png",
                     "slug": "airـcondition",
                     "value": "ddd"
                   }
                 ],
                 "color": [
                   {
                     "id": 1,
                     "name": "احمر",
                     "code": "#ff0000",
                     "slug": "red"
                   },
                   {
                     "id": 3,
                     "name": "اخضر",
                     "code": "#008000",
                     "slug": "green"
                   }
                 ],
                 "user": {
                   "id": 1,
                   "full_name": "admin",
                   "email": "admin@gmail.com",
                   "token": "A3hGf9MHH1soieRtRYaAfLNojF9QUXHsq9Fnafnk",
                   "mobile": "01080482343"
                 },
                 "location": ""
               }
             ],
             "error": ""
           }
```



# getFeaturedCars  
POST : http://159.203.131.31/api/v1/getFeaturedCars<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)",
    "brand_id" : "Optionl if you pass it will select cars depend on brand_id",
    "brand_model_id" : "Optionl brand_model_id",
    "to" : "Optionl will select cars less than this price",
    "form" : "Optionl will select cars form and highter than this price",
    "limit" : "Optional By default will return 20 Brand Model in once you can change this By Send naother limit",
    "offset" : "Optional will select start point from database like give me from id 10",
    "status" : "Optional get cars with one status only value(pending , accepted , reject)",
    "user_id" : "Optionl value('user_id' , 'customer_id') if you choose type new  pass user_id the admin who add the car  , if type pass empty make sure you return with customer id"  ,
    "name" : "Optional it for search by car name",
 
}
```
```
response:{
         	"status": true,
         	"data": [
         		{
         			"id": 1,
         			"price": 10000,
         			"name": "Jeeb bmw X5",
         			"phone": "01080482833",
         			"year": 2014,
         			"description": "3000 Km \r\nAutomatic\r\nNew Case\r\n3 years linces",
         			"status": "Pending",
         			"image": [
         				"http://159.203.131.31/files/50446_1497435539.jpg"
         			],
         			"slug": "Jeeb_bmw_X5",
         			"brandModel": {
         				"id": 1,
         				"name": "بي ام دبيو  جيب",
         				"slug": "bmw_jeb",
         				"brand": {
         					"id": 1,
         					"name": "بي ام دبيو",
         					"image": "http://159.203.131.31/files/30573_1496663695.png",
         					"slug": "bmw"
         				}
         			},
         			"specs": [
         				{
         					"id": 1,
         					"name": "تكيف",
         					"icon": "http://159.203.131.31/files/84746_1496734566.png",
         					"slug": "airـcondition",
         					"value": "asdasd"
         				},
         				{
         					"id": 2,
         					"name": "فتحة سقف",
         					"icon": "http://159.203.131.31/files/68788_1496734802.png",
         					"slug": "sunـroof",
         					"value": "asdasd"
         				}
         			],
         			"color": [
         				{
         					"id": 2,
         					"name": "اسود",
         					"code": "#000000",
         					"slug": "black"
         				},
         				{
         					"id": 3,
         					"name": "اخضر",
         					"code": "#008000",
         					"slug": "green"
         				}
         			],
         			"user": {
         				"id": 1,
         				"full_name": null,
         				"email": "admin@gmail.com",
         				"token": null,
         				"mobile": ""
         			},
         			"location": ""
         		}
         	],
         	"error": ""
         }
```





 # getSplash
POST : http://159.203.131.31/api/v1/getSplash<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)",
    "width" : "required in px like 320",
    "height" : "reuqired in px like 503"
}
```
```
response:{
  "status":true,
  "data":[
         {
            image":"http://159.203.131.31/files/84746_1496734566.png"
         }
  ],
  "error":""
}
```




 # getCarById
POST : http://159.203.131.31/api/v1/getCarById<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)",
    "type" : "optional value(new )for get new cars , empty to get old cars",
    "id" : "required car id"
}
```
```
response:{
             "status": true,
             "data": {
                 "id": 1,
                 "price": 10000,
                 "name": "Jeeb bmw X5",
                 "phone": "01080482833",
                 "year": 2014,
                 "description": "3000 Km \r\nAutomatic\r\nNew Case\r\n3 years linces",
                 "status": "Pending",
                 "image": [
                     "http://159.203.131.31/files/47665_1496745579.jpg",
                     "http://159.203.131.31/files/32022_1496745579.jpg"
                 ],
                 "slug": "Jeeb_bmw_X5",
                 "brandModel": {
                     "id": 1,
                     "name": "بي ام دبيو  جيب",
                     "slug": "bmw_jeb",
                     "brand": {
                         "id": 1,
                         "name": "بي ام دبيو",
                         "image": "http://159.203.131.31/files/30573_1496663695.png",
                         "slug": "bmw"
                     }
                 },
                 "specs": [
                     {
                         "id": 1,
                         "name": "تكيف",
                         "icon": "http://159.203.131.31/files/84746_1496734566.png",
                         "slug": "airـcondition",
                         "value": "asdasd"
                     },
                     {
                         "id": 2,
                         "name": "فتحة سقف",
                         "icon": "http://159.203.131.31/files/68788_1496734802.png",
                         "slug": "sunـroof",
                         "value": "asdasd"
                     }
                 ],
                 "color": [
                     {
                         "id": 2,
                         "name": "اسود",
                         "code": "#000000",
                         "slug": "black"
                     },
                     {
                         "id": 3,
                         "name": "اخضر",
                         "code": "#008000",
                         "slug": "green"
                     }
                 ],
                 "user": {
                     "id": 1,
                     "full_name": null,
                     "email": "admin@gmail.com",
                     "token": null,
                     "mobile": null
                 },
                 "location": ""
             },
             "error": ""
         }
```



# splash
just call this url http://159.203.131.31/files/splash/ <br>
and then put width X Height <br>
Example with width 320,503<br>
http://159.203.131.31/files/splash/320X503.jpg


# addCar
 Header<br>
 Content-Type application/json<br>
 Authorization Bearer A3hGf9MHH1soieRtRYaAfLNojF9QUXHsq9Fnafnk<br>
POST : http://159.203.131.31/api/v1/addCar<br>
you must send with json format<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
        "name" : "required , type(string)",
        "year" : "required , type(integer) -> 1990",
        "des": "required , type(string)",
        "brand_id" : "required , type(intger) -> getlist of beand form getBrands api",
        "model_name" :"required , type(string)",
        "customer_id" : "required , type(intger) -> login user Id",
        "price" : "required , type(float)",
        "mobile" : "required",
        "image" : ["image_one","image_three","image_two"],
        "color_id" : [1,2,3],
        "specs_id" : [{"1":"Des for  one specs"},{"3":"Des for two specs"}],
        "location" : "required , type(text)"
}
```

Test case  make sure there  are no  \n or  \t

```

testCase : {"name" : "132 " ,"year" :"1780","des" : "1000 cc with radio hi quailty", "location" : "location" ,"brand_id" : "1" ,"model_name" : "Dummy text" ,"customer_id" : "1","price" : "10000","mobile" : "0108048283", "image":["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"],"color_id":[1,2,3], "specs_id":[ {"1":"Des for  one specs"},{"3":"Des for two specs"} ]}

```

```
response:{
  "status":true,
  "data":[
         "Done Add Car"
  ],
  "error":""
}
```
 # addContactUs
POST : http://159.203.131.31/api/v1/addContactUs<br>
status -> (true , false)<br>
data -> array of objects will be empty if no data found<br>
error -> error messages will be empty if no error <br>
```
payloads:{
    "lang" : "required value(ar,en)",
    "name" : "required ",
    "email" : "required ",
    "phone" : "required number",
    "massage" : "required "
}
```
```
response:{
{"status":"true","data":"Contact Us sent successfully","error":""}
         }
```