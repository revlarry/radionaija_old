<!DOCTYPE html>
<html lang="en">

<head>
<style>
.table-fixed thead {
  width: 97%;
}
.table-fixed tbody {
  height: 230px;
  overflow-y: auto;
  width: 100%;
}
.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
  display: block;
}
.table-fixed tbody td, .table-fixed thead > tr> th {
  float: left;
  border-bottom-width: 0;
}
</style>
</head>

<body>
<div class="container">
  <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>
            Fixed Header Scrolling Table 
          </h4>
        </div>
        <table class="table table-fixed">
          <thead>
            <tr>
              <th class="col-xs-2">#</th><th class="col-xs-8">Name</th><th class="col-xs-2">Points</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="col-xs-2">1</td><td class="col-xs-8">Mike Adams</td><td class="col-xs-2">23</td>
            </tr>
            <tr>
              <td class="col-xs-2">2</td><td class="col-xs-8">Holly Galivan</td><td class="col-xs-2">44</td>
            </tr>
            <tr>
              <td class="col-xs-2">3</td><td class="col-xs-8">Mary Shea</td><td class="col-xs-2">86</td>
            </tr>
            <tr>
              <td class="col-xs-2">4</td><td class="col-xs-8">Jim Adams</td><td>23</td>
            </tr>
            <tr>
              <td class="col-xs-2">5</td><td class="col-xs-8">Henry Galivan</td><td class="col-xs-2">44</td>
            </tr>
            <tr>
              <td class="col-xs-2">6</td><td class="col-xs-8">Bob Shea</td><td class="col-xs-2">26</td>
            </tr>
            <tr>
              <td class="col-xs-2">7</td><td class="col-xs-8">Andy Parks</td><td class="col-xs-2">56</td>
            </tr>
            <tr>
              <td class="col-xs-2">8</td><td class="col-xs-8">Bob Skelly</td><td class="col-xs-2">96</td>
            </tr>
            <tr>
              <td class="col-xs-2">9</td><td class="col-xs-8">William Defoe</td><td class="col-xs-2">13</td>
            </tr>
            <tr>
              <td class="col-xs-2">10</td><td class="col-xs-8">Will Tripp</td><td class="col-xs-2">16</td>
            </tr>
            <tr>
              <td class="col-xs-2">11</td><td class="col-xs-8">Bill Champion</td><td class="col-xs-2">44</td>
            </tr>
            <tr>
              <td class="col-xs-2">12</td><td class="col-xs-8">Lastly Jane</td><td class="col-xs-2">6</td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</div>
</body>
</html>