<?php
$language = array (
  'admin:inbox' => 'Réglages de la boîte aux lettres',
  'admin:inbox:message_types' => 'Types de messages',
  'item:object:message:create' => 'Ajouter un nouveau type de message',
  'item:object:message:name' => 'Nom de type unique',
  'item:object:message:setting:multiple' => 'Autoriser des destinataires multiples',
  'item:object:message:setting:attachments' => 'autoriser les fichiers',
  'item:object:message:setting:persistent' => 'Rendre permanent (ne peut être effacé par le destinataire)',
  'item:object:message:setting:policy' => 'Politique de communication',
  'item:object:message:setting:policy:help' => 'Précise les ensembles d’utilisateurs entre lesquels cette communication peut avoir lieu. Les champs « Expéditeur » et « Destinataire » précisent les types d’utilisateurs (en fonction de leurs « rôles » sur le site). « Rapport avec le destinataire » précise le type de rapport qui doit exister entre l’expéditeur et le destinataire pour que cette communication puisse avoir lieu (p. ex., l’expéditeur doit être un ami du destinataire). « Relation inverse » précise que le type de relation doit être inversé (p. ex., que le destinataire doit être un ami de l’expéditeur pour que le destinataire puisse contacter l’expéditeur). « Relation de l’expéditeur avec le groupe » crée un niveau de filtration supplémentaire, en vertu duquel 1) le destinataire doit être membre d’un groupe et 2) l’expéditeur doit entretenir un rapport précis avec ce groupe (p. ex., le réglage sur « membre » indique que ce type de communication ne peut avoir lieu qu’entre les membres du même groupe)',
  'item:object:message:all' => 'Tous les messages',
  'hj:inbox:admin:import' => 'Importer les plus vieux messages',
  'hj:inbox:admin:import_stats' => '%s de messages auxquels manquent les métadonnées nécessaires pour une compatibilité avec hypeInbox',
  'hj:inbox:admin:import_start' => 'Commencer l’importation',
  'hj:inbox:admin:import_complete' => 'Importation terminée',
  'hj:inbox:user_type:all' => 'N’importe quel utilisateur',
  'hj:inbox:user_type:admin' => 'Administrateur',
  'hj:inbox:user_type:editor' => 'Rédacteur',
  'hj:inbox:user_type:supervisor' => 'Superviseur',
  'hj:inbox:user_type:observer' => 'Observateur',
  'item:object:message:label:singular' => 'Étiquette (au singulier)',
  'item:object:message:label:plural' => 'Étiquette (au pluriel)',
  'hj:inbox:send' => 'Expédier %s',
  'hj:inbox:sender' => 'Expéditeur',
  'hj:inbox:relationship' => 'Relation avec le destinataire',
  'hj:inbox:recipient' => 'Destinataire',
  'hj:inbox:inverse_relationship' => 'Relation inverse',
  'hj:inbox:group_relationship' => 'Relation de l’expéditeur avec le groupe dont le destinataire est membre',
  'hj:inbox' => 'Messages',
  'hj:inbox:all' => 'Tous les messages',
  'hj:inbox:inbox' => 'Boîte à lettres',
  'hj:inbox:sent' => 'Messages envoyés',
  'hj:inbox:compose' => 'Composer',
  'hj:inbox:usersettings:grouping' => 'Regroupement des messages de la boîte aux lettres par l’expéditeur',
  'hj:inbox:group' => 'Regrouper',
  'hj:inbox:dontgroup' => 'Ne pas regrouper',
  'hj:inbox:message_not_found' => 'Message introuvable',
  'hj:inbox:untitled' => 'Sans titre',
  'hj:inbox:you' => 'Vous',
  'hj:inbox:thread' => 'Visionner tous %s les messages dans ce fil',
  'hj:inbox:thread:unread' => '%s de nouveau',
  'hj:inbox:message' => 'Message : %s',
  'hj:inbox:conversation' => 'Conversation entre vous et %s',
  'hj:inbox:nomessages' => 'Il n’y a pas de messages dans ce dossier',
  'messages:attachments' => 'Fichiers',
  'hj:inbox:load:before' => 'Charger les messages %s préalables',
  'hj:inbox:load:after' => 'Charger les messages %s suivants',
  'hj:inbox:delete' => 'Effacer',
  'hj:inbox:markread' => 'Marquer comme lu',
  'hj:inbox:markunread' => 'Marquer comme non lu',
  'hj:inbox:delete:success' => '%s de messages qui ont été effacés avec succès',
  'hj:inbox:markread:success' => '%s de %s messages qui ont été marqués lus',
  'hj:inbox:markunread:success' => '%s de %s messages qui ont été marqués non lus',
  'hj:inbox:error:notfound' => '%s de messages introuvables',
  'hj:inbox:error:persistent' => '%s de messages qui n’ont pas pu être effacés du fait qu’ils sont en mode lecture seule',
  'hj:inbox:error:unknown' => '%s de messages qui n’ont pas pu être effacés à cause d’une erreur inconnue',
  'hj:inbox:delete:thread:confirm' => 'Êtes-vous bien sûr de vouloir effacer tous les messages dans ce fil?',
  'hj:inbox:delete:message:confirm' => 'Êtes-vous bien sûr de vouloir effacer ce message?',
);
add_translation("fr", $language);
