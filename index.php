<!doctype html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styl.css" />
  <title>ZGŁOSZENIA</title>
</head>

<body>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "zgloszenia";

  $connection = mysqli_connect(hostname: $servername, username: $username, password: $password = "", database: $dbname);
  ?>
  <header class="blokNaglowkowy">
    <h1>Zgłoszenia wydarzeń</h1>
  </header>
  <main class="blokGlowny">
    <section class="SekcjaL">
      <h2>Personel</h2>
      <form action="index.php" method="post">
        <input type="radio" name="Radio" id="Policjant" value="policjant" checked>
        <label for="Policjant">Policjant</label>

        <input type="radio" name="Radio" id="Ratownik" value="ratownik">
        <label for="Ratownik">Ratownik</label>

        <button>Pokaż</button>

      </form>
      <?php
      if (isset($_POST["Radio"])) {
      $connection = mysqli_connect(hostname: $servername, username: $username, password: $password = "", database: $dbname);
      $opcja = $_POST['Radio'];
      echo "Wybrano opcję: ", $opcja;
      mysqli_close($connection);
      }
      ?>
      <table>
        <tr>
          <th>ID</th>
          <th>Imie</th>
          <th>Nazwisko</th>
        </tr>
        <?php
        if (isset($_POST["Radio"])) {
          $connection = mysqli_connect(hostname: $servername, username: $username, password: $password = "", database: $dbname);
          $query2 = "SELECT id,imie,nazwisko FROM `personel` WHERE status = '{$opcja}'";
          $result2 = mysqli_query($connection, $query2); 

          while ($a = mysqli_fetch_array($result2)) {
            echo "<tr>",
              "<td>",
                $a['id'],
              "</td>",
              "<td>",
              $a['imie'],
              "</td>",
              "<td>",
              $a['nazwisko'],
              "</td>",
              "</tr>";
          }


          mysqli_close($connection);
        }
        ?>
      </table>
    </section>
    <section class="SekcjaP">
      <h2>Nowe zgłoszenie</h2>
      <ol>
        <?php
        $connection = mysqli_connect(hostname: $servername, username: $username, password: $password = "", database: $dbname);
        $query = 'SELECT id, nazwisko FROM personel WHERE id NOT IN (SELECT id_personel FROM rejestr)';
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($result)) {
          echo "<li>", $row['id'], '.', $row['nazwisko'], "</li>";
        }
        ;


        mysqli_close($connection);
        ?>
      </ol>
      <form action="index.php" method="post">
        <label for="wybierz">Wybierz id osoby z listy:</label>
        <input type="number" id="wybierz" name="Wybierz">
        <button id="DodajZgloszenie">Dodaj zgłoszenie</button>
      </form>
      <?php

      if ($_POST) {
        $connection = mysqli_connect(hostname: $servername, username: $username, password: $password = "", database: $dbname);
        $id = $_POST['Wybierz'];
        $query1 = "INSERT INTO `rejestr`(`data`, `id_personel`, `id_pojazd`) VALUES (CURRENT_DATE,{$id},'14')";
        $result1 = mysqli_query($connection, $query1);
        mysqli_close($connection);
      }

      ?>
    </section>
  </main>
  <footer class="blokStopki">
    <p>Stronę wykonał: 0000000000000</p>
  </footer>
</body>

</html>