USE `northwind`;

#Exercice 1
SELECT `CompanyName` AS 'Société', `ContactName` AS 'contact', `ContactTitle` AS 'Fonction', `Phone` AS 'Téléphone'
FROM `customers`
WHERE `Country` = 'France';

#Exercice 2
SELECT `products`.`ProductName` AS 'Produit', `products`.`UnitPrice` AS 'Prix'
FROM `suppliers`
INNER JOIN `products` ON `suppliers`.`SupplierID` = `products`.`SupplierID`
WHERE `suppliers`.`CompanyName` = 'Exotic Liquids';

#Exercice 3
SELECT `suppliers`.`CompanyName` AS 'Fournisseur', COUNT(`products`.`ProductID`) AS 'Nbre produits'
FROM `suppliers`
INNER JOIN `products` ON `suppliers`.`SupplierID` = `products`.`SupplierID`
WHERE `suppliers`.`Country` = 'France'
GROUP BY `suppliers`.`SupplierID`
ORDER BY COUNT(`products`.`ProductID`) DESC, Fournisseur;

#Exercice 4
SELECT `customers`.`CompanyName` AS 'Client', COUNT(`orders`.`OrderID`) AS 'Nbre commandes'
FROM `orders`
INNER JOIN `customers` ON `orders`.`CustomerID` = `customers`.`CustomerID`
WHERE `customers`.`CustomerID` IN (
    SELECT `customers`.`CustomerID`
    FROM `customers`
    WHERE `customers`.`Country` = 'France'
)
GROUP BY `customers`.`CustomerID`
HAVING COUNT(`orders`.`OrderID`) > 10;

#Exercice 5
SELECT `customers`.`CompanyName` AS 'Client', SUM((`order details`.`UnitPrice` * `order details`.`Quantity`) - `order details`.`Discount`) AS 'CA', `customers`.`Country` AS 'Pays'
FROM ((`orders`
INNER JOIN `customers` ON `orders`.`CustomerID` = `customers`.`CustomerID`)
INNER JOIN `order details` ON `orders`.`OrderID` = `order details`.`OrderID`)
GROUP BY `orders`.`CustomerID`
HAVING CA > 30000
ORDER BY CA DESC;

#Exercice 6
SELECT `customers`.`Country` AS 'Pays'
FROM ((`customers`
INNER JOIN `orders` ON `customers`.`CustomerID` = `orders`.`CustomerID`)
INNER JOIN `order details` ON `orders`.`OrderID` = `order details`.`OrderID`)
WHERE `order details`.`ProductID` IN (
    SELECT `products`.`ProductID`
    FROM `products`
    INNER JOIN `suppliers` ON `products`.`SupplierID` = `suppliers`.`SupplierID`
    WHERE `suppliers`.`CompanyName` = 'Exotic Liquids'
)
GROUP BY `customers`.`Country`;

#Exercice 7
SELECT SUM((`order details`.`UnitPrice` * `order details`.`Quantity`) - `order details`.`Discount`) AS 'Montant Ventes 97'
FROM `order details`
INNER JOIN `orders` ON `order details`.`OrderID` = `orders`.`OrderID`
WHERE YEAR(`orders`.`OrderDate`) = 1997;

#Exercice 8
SELECT MONTH(`orders`.`OrderDate`) AS 'Mois 97', SUM((`order details`.`UnitPrice` * `order details`.`Quantity`) - `order details`.`Discount`) AS 'Montant Ventes'
FROM `order details`
INNER JOIN `orders` ON `order details`.`OrderID` = `orders`.`OrderID`
WHERE YEAR(`orders`.`OrderDate`) = 1997
GROUP BY MONTH(`orders`.`OrderDate`);

#Exercice 9
SELECT `orders`.`OrderDate` AS 'Date de dernière commande'
FROM `customers`
INNER JOIN `orders` ON `customers`.`CustomerID` = `orders`.`CustomerID`
WHERE `customers`.`CompanyName` = 'Du monde entier' AND DATEDIFF(CURRENT_TIMESTAMP, `orders`.`OrderDate`) = (
    SELECT MIN(DATEDIFF(CURRENT_TIMESTAMP, `orders`.`OrderDate`))
    FROM `customers`
    INNER JOIN `orders` ON `customers`.`CustomerID` = `orders`.`CustomerID`
    WHERE `customers`.`CompanyName` = 'Du monde entier'
);

#Exercice 10
SELECT ROUND(AVG(DATEDIFF(`ShippedDate`, `OrderDate`))) AS 'Délai moyen de livraison en jours'
FROM `orders`
#optionnelle, condition qui retire les entrées où la date de livraison n'a pas encore été enregistrée dans la base
#WHERE ISNULL(`ShippedDate`) != 1 
;