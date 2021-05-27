# JKCOVID-Update

JKCOVID Update is a Laravel based project which aims to provide a consolidated view of COVID related data specific to J&K.


This project provides simple REST API's for getting COVID related data besides a minimalistic frontend to display and visualize that data. 

This Can be accessed at [jkcovidupdates.herokuapp.com](https://jkcovidupdates.herokuapp.com/)

### Data Source
The data source for our API's is  [@diprjk](https://twitter.com/diprjk)  which is the Official Twitter handle of Department of Information and Public Relations, Govt of Jammu & Kashmir. For automatic data updation an another plugin based on Apache-Airflow which can be found [here](https://github.com/kundroomajid/twitter_plugin) is used.


### API Endpoints


1.  Get consolidated stats like total active, recovered, total postive, and deaths


    **URL** : `/api/stats/all/{region?}`

    **Method** : `GET`

    **Param** : `region` (name of any district of jk default to whole JK)

    **Auth required** : NO


    **Example**

    `GET` : `/api/stats/all/anantnag`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
    "status": "success",
    "data": 
        {
            "date": "2021-05-08",
            "name": "anantnag",
            "postive_total": 9779,
            "recovered_total": 6219,
            "deaths_total": 119,
            "last_updated": "2021-05-09T21:16:55.000000Z"
        }
    }
    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```

2.  Get latest stats like total active, recovered, total postive, and deaths.


    **URL** : `/api/stats/latest/{region?}`

    **Method** : `GET`

    **Param** : `region` (name of any district of jk default to whole JK)

    **Auth required** : NO


    **Example**

    `GET` : `/api/stats/latest/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
    "status": "success",
    "region": "jk",
    "data": 
    {
        "id": 2513,
        "date": "2021-05-08",
        "name": "jk",
        "postive_new": 4788,
        "recovered_new": 2500,
        "deaths_new": 60,
        "last_updated": "2021-05-09T21:16:55.000000Z"
        }
    }
    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```



3.  Get yesterdays stats like total active, recovered, total postive, and deaths.


    **URL** : `/api/stats/yesterday/{region?}`

    **Method** : `GET`

    **Param** : `region` (name of any district of jk default to whole JK)

    **Auth required** : NO


    **Example**

    `GET` : `/api/stats/yesterday/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
    "status": "success",
    "region": "jk",
    "data": 
    {
        "id": 2513,
        "date": "2021-05-08",
        "name": "jk",
        "postive_new": 4788,
        "recovered_new": 2500,
        "deaths_new": 60,
        "last_updated": "2021-05-09T21:16:55.000000Z"
        }
    }
    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```

4.  Get latest for specied date and region stats like total active, recovered, total postive, and deaths.


    **URL** : `/api/stats/date/{date}/{region?}`

    **Method** : `GET`

    **Param** : `region` optional (name of any district of jk default to whole JK)

    **Param** : `date` date in format `yyyy-mm-dd`

    **Auth required** : NO


    **Example**

    `GET` : `/api/stats/date/2021-04-22/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
    "status": "success",
    "region": "jk",
    "data": 
    {
        "id": 2513,
        "date": "2021-04-22",
        "name": "jk",
        "postive_new": 4788,
        "recovered_new": 2500,
        "deaths_new": 60,
        "last_updated": "2021-05-09T21:16:55.000000Z"
        }
    }
    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.
    **Condition** : If date is in invalid format or data for date is not avalaible.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```

5.  Get stats like total active, recovered, total postive, and deaths for current week.


    **URL** : `/api/stats/currweek/{region?}`

    **Method** : `GET`

    **Param** : `region` optional (name of any district of jk default to whole JK)

    **Auth required** : NO


    **Example**

    `GET` : `/api/stats/currweek/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    { 
        "status": "success",
        "region": "jk",
        "data": 
        {
            "week": "2021-05-02:2021-05-09",
            "postive_total": 28256,
            "recovered_total": 13840,
            "deaths_total": 302
        }
    }

    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```


6.  Get stats like total active, recovered, total postive, and deaths for Previous week.


    **URL** : `/api/stats/prevweek/{region?}`

    **Method** : `GET`

    **Param** : `region` optional (name of any district of jk default to whole JK)

    **Auth required** : NO


    **Example**

    `GET` : `/api/stats/prevweek/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    { 
        "status": "success",
        "region": "jk",
        "data": 
        {
            "week": "2021-05-02:2021-05-09",
            "postive_total": 28256,
            "recovered_total": 13840,
            "deaths_total": 302
        }
    }

    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```

7.  Get stats like total active, recovered, total postive, and deaths for Current Month.


    **URL** : `/api/stats/currmonth/{region?}`

    **Method** : `GET`

    **Param** : `region` optional (name of any district of jk default to whole JK)

    **Auth required** : NO


    **Example**

    `GET` : `/api/stats/currmonth/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
        "status":"success",
        "region":"jk",
        "data":{
            "Month":"05-2021",
            "postive_total":31827,
            "recovered_total":15293,
            "deaths_total":343
        }
    }

    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```

8.  Get stats like total active, recovered, total postive, and deaths for Previous Month.


    **URL** : `/api/stats/prevmonth/{region?}`

    **Method** : `GET`

    **Param** : `region` optional (name of any district of jk default to whole JK)

    **Auth required** : NO


    **Example**

    `GET` : `/api/stats/prevmonth/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
        "status":"success",
        "region":"jk",
        "data":{
            "Month":"04-2021",
            "postive_total":44662,
            "recovered_total":18892,
            "deaths_total":285
        }
    }

    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```

9.  Get stats like total active, recovered, total postive, and deaths for Specified Month.


    **URL** : `/api/stats/month/{month}/{region?}`

    **Method** : `GET`

    **Param** : `region` optional (name of any district of jk default to whole JK)

     **Param** : `month` month for which data is to be fetched format `yyyy-mm`

    **Auth required** : NO


    **Example**

    `GET` : `/api/stats/month/2021-03/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
        "status":"success",
        "region":"jk",
        "data":{
            "Month":"04-2021",
            "postive_total":44662,
            "recovered_total":18892,
            "deaths_total":285
        }
    }

    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

     **Condition** : The date format is incorrect or data for that month is not avalaible.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```
10. Get daily datewise stats like postive, recovered, deaths.

    **URL** : `/api/stats/daily/{region?}`

    **Method** : `GET`

    **Param** : `region` optional default to jk (allowed : jk,kashmir_div,jammu_div)

    **Auth required** : NO

    **Example**

    `GET` : `/api/stats/daily/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
    "status": "success",
    "data": [
        {
        "date": "2020-04-10",
        "postive": 0,
        "recovered": 0,
        "deaths": 0
        },
        {
        "date": "2020-04-11",
        "postive": 17,
        "recovered": 0,
        "deaths": 0
        }
      ]
    }

    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```

11. Get week wise consolidated stats like postive, recovered, deaths.

    **URL** : `/api/stats/weekly/{region?}`

    **Method** : `GET`

    **Param** : `region` optional default to jk (allowed : jk,kashmir_div,jammu_div)

    **Auth required** : NO

    **Example**

    `GET` : `/api/stats/weekly/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
        "status": "success",
        "region": "jk",
        "data": [
        {
            "postive": "0",
            "recovered": "0",
            "deaths": "0",
            "week": "2020-04-12:2020-04-17"
        },
        {
        "postive": "17",
        "recovered": "0",
        "deaths": "0",
        "week": "2020-04-12:2020-04-18"
        }
      ]
    }
    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```

12. Get month wise consolidated stats like postive, recovered, deaths.

    **URL** : `/api/stats/monthly/{region?}`

    **Method** : `GET`

    **Param** : `region` optional default to jk (allowed : jk,kashmir_div,jammu_div)

    **Auth required** : NO

    **Example**

    `GET` : `/api/stats/monthly/jk`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
    "status": "success",
    "region": "jk",
    "data": [
        {
            "postive": "407",
            "recovered": "210",
            "deaths": "4",
            "month": "April-2020"
        },
        {
            "postive": "1832",
            "recovered": "711",
            "deaths": "20",
            "month": "May-2020"
        },
        {
            "postive": "5051",
            "recovered": "3795",
            "deaths": "73",
            "month": "June-2020"
        }
     ]
    }
    ```

    ## Error Response

    **Condition** : If param is not a valid district or region of JK.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```
13. Get detailed latest stats avalaible for all regions 

    **URL** : `/api/stats/detailed/{date?}`

    **Method** : `GET`

    **Param** : `date` optional date for which data is required of format `yyyy-mm-dd`. If date is not provided it will fetch the latest details.

    **Auth required** : NO

    **Example**

    `GET` : `/api/stats/detailed`


    ## Success Response

    **Code** : `200 OK`

    **Content example**

    ```json
    {
    "status": "success",
    "data": [
        {
            "name": "srinagar",
            "date": "2021-05-08",
            "postive_new": 853,
            "postive_total": 52214,
            "total_active": 10951,
            "recovered_new": 697,
            "recovered_total": 40661,
            "deaths_new": 60,
            "deaths_total": 602,
            "last_updated": "2021-05-09T21:16:55.000000Z"
        },
        {
            "name": "baramulla",
            "date": "2021-05-08",
            "postive_new": 470,
            "postive_total": 15950,
            "total_active": 3980,
            "recovered_new": 224,
            "recovered_total": 11759,
            "deaths_new": 60,
            "deaths_total": 211,
          "last_updated": "2021-05-09T21:16:55.000000Z"
        }
     ]
    }
    ```

    ## Error Response

    **Condition** : if date in wrong format or data for the date is not avalaible.

    **Code** : `400 BAD REQUEST`

    **Content** :

    ```json
    {
    "status": "failure",
    "message": "Data Not Found"
    }
    ```
