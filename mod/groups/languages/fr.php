<?php
	/**
	 * Traduction Française pour la 1.5 Florian Daniel http://id.facyla.net/
         * Ajout/modification pour la 1.7 Christophe Goddon chgoddon@gmail.com
	 */

	$french = array(

		/**
		 * Menu items and titles
		 */

			'groups' => "Groupes",
			'groups:owned' => "Les groupes que vous possedez",
			'groups:yours' => "Vos groupes",
			'groups:user' => "Les groupes de %s",
			'groups:all' => "Tous les groupes du site",
			'groups:new' => "Créer un nouveau groupe",
			'groups:edit' => "Modifier le groupe",
			'groups:delete' => 'Supprimer le groupe',
			'groups:membershiprequests' => 'Gérer les membres souhaitant se joindre au groupe',
			'groups:invitations' => 'Invitations du groupe',

			'groups:icon' => "Icone du groupe (ne rien inscrire pour laisser inchangé)",
			'groups:name' => 'Nom du groupe',
			'groups:username' => "Nom court du goupe (Qui s'affichera dans l'URL : en caractères alphanumériques)",
			'groups:description' => 'Description',
			'groups:briefdescription' => 'Brève description',
			'groups:interests' => 'Intérêts',
			'groups:website' => 'Site web',
			'groups:members' => 'Membres du groupe',
			'groups:membership' => "Permissions d'accès au groupe",
			'groups:access' => "Permissions d'accès",
			'groups:owner' => "Propriétaire",
	        'groups:widget:num_display' => 'Nombre de groupes à afficher',
	        'groups:widget:membership' => 'Adhésion au groupe',
	        'groups:widgets:description' => 'Afficher les groupes dont vous êtes membre dans votre profil',
			'groups:noaccess' => "Vous n'avez pas accès au groupe",
			'groups:cantedit' => 'Vous ne pouvez pas modifier ce groupe',
			'groups:saved' => 'Groupe enregistré',
			'groups:featured' => 'Les groupes à la une',
			'groups:makeunfeatured' => 'Enlever de la une',
			'groups:makefeatured' => 'Mettre en une',
			'groups:featuredon' => 'Vous avez mis ce groupe à la une.',
			'groups:unfeature' => "Ce groupe n'est plus à la une",
			'groups:joinrequest' => 'Demander une adhésion au groupe',
			'groups:join' => 'Rejoindre le groupe',
			'groups:leave' => 'Quitter le groupe',
			'groups:invite' => 'Inviter des contacts',
			'groups:inviteto' => "Inviter des contacts au groupe '%s'",
			'groups:nofriends' => "Vous n'avez plus de contacts à inviter à ce groupe.",
			'groups:viagroups' => "Via les groupes",
			'groups:group' => "Groupe",
			'groups:search:tags' => "Tag",

			'groups:memberlist' => "Membres du groupe",
			'groups:membersof' => "Membres de %s",
			'groups:members:more' => "Afficher plus de membres",

			'groups:notfound' => "Le groupe n'a pas été trouvé",
			'groups:notfound:details' => "Le groupe que vous recherchez n'existe pas, ou alors vous n'avez pas la permission d'y accéder",

			'groups:requests:none' => "Il n'y a pas de membre demandant de rejoindre le groupe en ce moment.",

			'groups:invitations:none' => 'Il n\'y a pas d\'invitations en attente.',

			'item:object:groupforumtopic' => "Sujets de discussion",

			'groupforumtopic:new' => "Une nouvelle discussion a été publiée",

			'groups:count' => "groupe créé",
			'groups:open' => "groupe ouvert",
			'groups:closed' => "groupe fermé",
			'groups:member' => "membres",
			'groups:searchtag' => "Rechercher des groupes par des mots-clé",


			/*
			 * Access
			 */
			'groups:access:private' => 'Fermé - Les utilisateurs doivent être invités',
			'groups:access:public' => "Ouvert - N'importe quel utilisateur peut rejoindre le groupe",
			'groups:closedgroup' => 'Ce groupe est en adhésion privée.',
			'groups:closedgroup:request' => 'Pour le rejoindre cliquez sur le lien "Demander une adhésion au groupe".',
			'groups:visibility' => 'Qui peut voir ce groupe?',

			/*
			Group tools
			*/
			'groups:enablepages' => 'Activer le module "page" du groupe',
			'groups:enableforum' => 'Activer le module "discussion" du groupe',
			'groups:enablefiles' => 'Activer le module "fichier" du groupe',
			'groups:yes' => 'oui',
			'groups:no' => 'non',

			'group:created' => 'Créé %s avec %d publications',
			'groups:lastupdated' => 'Dernière mise à jour %s par %s',
			'groups:lastcomment' => 'Dernier commentaire %s par %s',
			'groups:pages' => 'Les pages du groupe',
			'groups:files' => 'Les fichiers du groupe',

			/*
			Group forum strings
			*/

			'group:replies' => 'Réponses',
			'groups:forum' => 'Forum du groupe',
			'groups:addtopic' => 'Ajouter un sujet',
			'groups:forumlatest' => 'Dernière discussion',
			'groups:latestdiscussion' => 'Dernière discussion',
			'groups:newest' => 'Récents',
			'groups:popular' => 'Populaires',
			'groupspost:success' => 'Votre commentaire a été publié avec succés',
			'groups:alldiscussion' => 'Dernière discussion',
			'groups:edittopic' => 'Modifier le sujet',
			'groups:topicmessage' => 'Message du sujet',
			'groups:topicstatus' => 'Statut du sujet',
			'groups:reply' => 'Publier un commentaire',
			'groups:topic' => 'Sujets',
			'groups:posts' => 'Posts',
			'groups:lastperson' => 'Dernière personne',
			'groups:when' => 'Quand',
			'grouptopic:notcreated' => "Aucun sujet n'a été créé.",
			'groups:topicopen' => 'Ouvert',
			'groups:topicclosed' => 'Fermé',
			'groups:topicresolved' => 'Résolu',
			'grouptopic:created' => 'Votre sujet a été créé.',
			'groupstopic:deleted' => 'Le sujet a été supprimé.',
			'groups:topicsticky' => 'Sticky',
			'groups:topicisclosed' => 'Ce sujet est fermé.',
			'groups:topiccloseddesc' => "Ce sujet a été fermé et n'accepte plus de nouveaux commentaires.",
			'grouptopic:error' => "Votre sujet n'a pas pu être créé. Merci d'essayer plus tard ou de contacter un administrateur du système.",
			'groups:forumpost:edited' => "Vous avez modifié ce billet avec succés.",
			'groups:forumpost:error' => "Il y a eu un problème lors de la modification du billet.",
			'groups:privategroup' => 'Ce groupe est privé. Il est nécessaire de demander une adhésion.',
			'groups:notitle' => 'Les groupes doivent avoir un titre',
			'groups:cantjoin' => "N'a pas pu rejoindre le groupe",
			'groups:cantleave' => "N'a pas pu quitter le groupe",
			'groups:addedtogroup' => "A ajouté avec succés l'utilisateur au groupe",
			'groups:joinrequestnotmade' => "La demande d'adhésion n'a pas pu être réalisée",
			'groups:joinrequestmade' => "La demande d'adhésion s'est déroulée avec succés",
			'groups:joined' => 'Vous avez rejoint le groupe avec succés !',
			'groups:left' => 'Vous avez quitter le groupe avec succés',
			'groups:notowner' => "Désolé, vous n'êtes pas le propriétaire du groupe.",
			'groups:notmember' => 'Désolé, vous n\'êtes pas membre de ce groupe.',
			'groups:alreadymember' => "Vous êtes déjà membre de ce groupe !",
			'groups:userinvited' => "L'utilisateur a été invité.",
			'groups:usernotinvited' => "L'utilisateur n'a pas pu être invité",
			'groups:useralreadyinvited' => "L\'utilisateur a déjà été invité",
			'groups:updated' => "Dernier commentaire",
			'groups:invite:subject' => "%s vous avez été invité(e) à rejoindre %s!",
			'groups:started' => "Démarré par",
			'groups:joinrequest:remove:check' => "Etes-vous sûr de vouloir supprimer cette demande d'adhésion ?",
			'groups:invite:remove:check' => 'Etes-vous sûr de vouloir supprimer cette invitation?',
			'groups:invite:body' => "Bonjour %s,

Vous avez été invité(e) à rejoindre le groupe '%s' cliquez sur le lien ci-dessous pour confirmer:

%s",

			'groups:welcome:subject' => "Bienvenue dans le groupe %s !",
			'groups:welcome:body' => "Bonjour %s!

Vous êtes maintenant membre du groupe '%s' ! Cliquez le lien ci-dessous pour commencer à participer !

%s",

			'groups:request:subject' => "%s a demandé une adhésion à %s",
			'groups:request:body' => "Bonjour %s,

%s a demandé à rejoindre le groupe '%s', cliquez le lien ci-dessous pour voir son profil :

%s

ou cliquez le lien ci-dessous pour confirmer son adhésion :

%s",

            /*
				Forum river items
			*/

			'groups:river:member' => '%s est maintenant membre de',
			'groups:river:create' => '%s a créé le groupe',
			'groupforum:river:updated' => '%s a mis à jour',
			'groupforum:river:update' => 'ce sujet de discussion',
			'groupforum:river:created' => '%s a créé',
			'groupforum:river:create' => 'un nouveau sujet de discussion intitulé',
			'groupforum:river:posted' => '%s a publié un nouveau commentaire',
			'groupforum:river:annotate:create' => 'sur ce sujet de discussion',
			'groupforum:river:postedtopic' => '%s a démarré un nouveau sujet de discussion intitulé',
			'groups:river:togroup' => 'pour le groupe',

			'groups:nowidgets' => "Aucun widget n'ont été défini pour ce groupe.",


			'groups:widgets:members:title' => 'Membres du groupe',
			'groups:widgets:members:description' => "Lister les membres d'un groupe.",
			'groups:widgets:members:label:displaynum' => "Lister les membres d'un groupe.",
			'groups:widgets:members:label:pleaseedit' => 'Merci de configurer ce widget.',

			'groups:widgets:entities:title' => "Objets dans le groupe",
			'groups:widgets:entities:description' => "Lister les objets enregistré dans ce groupe",
			'groups:widgets:entities:label:displaynum' => "Lister les objets d'un groupe.",
			'groups:widgets:entities:label:pleaseedit' => 'Merci de configurer ce widget.',

			'groups:forumtopic:edited' => 'Sujet du forum modifié avec succés.',

			'groups:allowhiddengroups' => 'Voulez-vous permettre les groupes privés (invisibles)?',

			/**
			 * Action messages
			 */
			'group:deleted' => 'Contenus du groupe et groupe supprimés',
			'group:notdeleted' => "Le groupe n'a pas pu être supprimé",

			'grouppost:deleted' => "La publication dans le groupe a été effacée",
			'grouppost:notdeleted' => "La publication dans le groupe n'a pas pu être effacée",
			'groupstopic:deleted' => 'Sujet supprimé',
			'groupstopic:notdeleted' => "Le sujet n'a pas pu être supprimé",
			'grouptopic:blank' => 'Pas de sujet',
			'grouptopic:notfound' => 'Le sujet n\'a pu être trouvé',
			'grouppost:nopost' => 'Pas d\'articles',
			'groups:deletewarning' => "Etes-vous sur de vouloir supprimer ce groupe ? Cette action est irréversible !",

			'groups:invitekilled' => "L'invitation a été supprimée.",
			'groups:joinrequestkilled' => "La demande d'adhésion a été supprimée.",
	);

	add_translation("fr",$french);
?>