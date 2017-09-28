
<?php session_start() ?>
<?php if(isset($_SESSION['nombre']))
{
    ?>
    <h1>Bienvenido de nuevo <?php echo $_SESSION['nombre'] ?>.</h1>

    <table style="width:100%">
        <tr>
            <th>Codigo promocional</th>
            <th>Canjear</th>
        </tr>
    <?php
    if(isset($_SESSION['promos']) and $_SESSION['promos'] != null){
        foreach ($_SESSION['promos'] as $valor){
            echo "<tr>";
            echo "<td>".$valor['promoCode']."</td>";
            if($valor['redeem']==1){
                echo "<td>";
                echo "<form action='../controllers/RedeemCode.php?method=redeemCode' method='post'>";
                echo "<input type='hidden' name='idPromo' value='".$valor['id']."'/>";
                echo "<input type='submit' value='Canjear' /></form></td>";
            }
            else{
                echo "<td class='redeemed'>Canjeado</td>";
            }
            echo "</tr>";
        }
    }?>
        <tr>
            <td>
                <form action='../controllers/RedeemCode.php?method=createRedeemCode' method='post'>
                    <input type='submit' value='Obtener nuevo codigo promocional' />
                </form>
            </td>
        </tr>
    </table>
    <?php
}else{
    header("Location: ../index.php");
}