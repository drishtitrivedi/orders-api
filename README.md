#### orders-api

#### Available Scripts

In the project directory, you can run in your treminal:
```
`php -S localhost:8000`
```

Runs the consumer/client app in the development mode.<br />
Open [http://localhost:8000/public/create](http://localhost:8000/public/create) to view it in the browser.

You will see any errors in the treminal.

### Start API server
```
`php -S localhost:8001`
```

Launches the API service at http://localhost:8001/public/api/order.<br />

#### Sample input body
```
{
    "item": "iPhone 11",
    "quantity": 5,
    "additional-items": {
        "wired-charger" : 2,
        "wireless-charger" : 3,
        "earpods" : 5,
        "screen-protactor" : 10,
        "case" : 10
    },
    "contact": {
        "firstName" : "Abcd",
        "lastName" : "Xyz",
        "email": "new@gmail.com",
        "phone": "9856451258"
    }
}
```
