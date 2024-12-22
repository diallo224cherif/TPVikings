## Le lien du repository GitHub
|--|
https://github.com/diallo224cherif/TPVikings
|--| 
### Repartition du travaille par groupe
|--|
ADIL a fait la partie:
|--|
Ajout d'une nouvelle table Weapon :
Création de la table avec les propriétés spécifiées dans la conception.
Ajout des fonctionnalités CRUD pour les armes :
Implémentation des fonctionnalités de création, lecture, mise à jour et suppression pour la table Weapon.
|--|
VASSILY a fait la partie:
|--|
Modification de la table viking :
Ajout de la colonne weaponId comme clé étrangère pointant vers la table Weapon (peut être NULL).
Mise à jour des fonctionnalités Read pour les vikings :
Modification des fonctionnalités findOne et findAll pour inclure les informations sur l'arme liée.
|--|
MAIMOUNATOU a fait la partie:
|--|
Mise à jour de la fonctionnalité Create pour les vikings :
Adaptation de la création de viking pour gérer la relation avec les armes.
Mise à jour de la fonctionnalité Update (avec PUT) :
Ajout ou modification des informations sur l'arme pour un viking existant.
Ajout d'une fonctionnalité Update dans le fichier api/viking/addWeapon.php :
Permettre d'ajouter ou de changer l'arme associée à un viking.
Partie Bonus :
Mise à jour des vikings en cas de suppression d'une arme :
Assurer que les vikings dont l'arme est supprimée sont correctement mis à jour (par exemple, suppression ou nullification de la clé étrangère).
Ajout de la fonctionnalité GET /viking/findByWeapon.php?id=<weaponId> :
Création d'un point de terminaison permettant de récupérer tous les vikings associés à une arme donnée.
Un export de l'environnement Postman dans le fichier vikings&weapon
|--|


