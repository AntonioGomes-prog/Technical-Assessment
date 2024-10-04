<!DOCTYPE html>
<html>
<head>
    <title>Server List</title>
</head>
<body>
    <h1>Available Servers</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Model</th>
                <th>RAM</th>
                <th>HDD</th>
                <th>Location</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody id="server-list">

        </tbody>
    </table>
</body>
<script>

    var servers = [
        {model: 'Dell R210Intel Xeon X3440', ram: '16GBDDR3', hdd: '2x2TBSATA2', location: 'AmsterdamAMS-01', price: '€49.99'},
        {model: 'HP DL180G62x Intel Xeon E5620', ram: '32GBDDR3', hdd: '8x2TBSATA2', location: 'AmsterdamAMS-01', price: '€119.00'}
    ];

    var tableBody = document.getElementById('server-list');
    servers.forEach(function(server) {
        var row = `<tr>
            <td>${server.model}</td>
            <td>${server.ram}</td>
            <td>${server.hdd}</td>
            <td>${server.location}</td>
            <td>${server.price}</td>
        </tr>`;
        tableBody.innerHTML += row;
    });
</script>
</html>
