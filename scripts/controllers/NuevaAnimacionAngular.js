

app.controller('NuevaAnimacionAngular', function ($scope) {
  $scope.activarAnimacion = false;

  $scope.pasteles = [
    {nombre: "Pastel de Moka :D"},
    {nombre: "Pastel de Trufa :3"},
    {nombre: "Cheesecake"},
    {nombre: "Tiramisú"},
    {nombre: "Tarta de Santiago"},
    {nombre: "Gelatina de Mango"},
    {nombre: "Gelatina de Frambuesa"},
    {nombre: "Pastel de Tres Leches"},
    {nombre: "Galletas de Gengibre"},
    {nombre: "Galletas de la Fortuna"}
  ];

  $scope.agregarPasteles = function() {
    $scope.pasteles.push($scope.pastel);
    $scope.pastel = {};
  };

  $scope.eliminarPasteles= function(index) {
    $scope.pasteles.splice(index, 1);
  };
});