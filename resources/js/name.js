axios.get('/api/user', {
    'headers':{
        'Accept' : 'application/json',
        'Authorization' : 'Bearer TMJwzFPQ78iWFlXNerb9wquvzgV7fpxn2IRRCC1xVQVFsYtKwyBYIIna4ga39fSw0ZiWTg8cvzZiVFoH'
    }
}).then(res => console.dir(res.data));