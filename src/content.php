<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — contenu éditorial de la plateforme.
 * Ressources authentiques, transcriptions, lexique, exercices et fiches pédagogiques.
 *
 * Fichier autonome (aucune extension requise) : déployable sur tout hébergement PHP 8.
 */

return [
  'resources' => [
    [
      'slug' => 'au-cafe-du-quartier',
      'title' => 'Au café du quartier',
      'subtitle' => 'Commander, payer et discuter en terrasse',
      'level' => 'A2',
      'theme' => 'culture',
      'audience' => 'tous',
      'mediaType' => 'video',
      'mediaUrl' => 'https://videos.pexels.com/video-files/28344955/12363393_1920_1080_30fps.mp4',
      'posterUrl' => 'https://images.pexels.com/videos/28344955/4k-photo-film-camera-france-paris-france-28344955.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=630&w=1200',
      'durationLabel' => '2 min 10',
      'durationSeconds' => 130,
      'excerpt' => 'Théo s\'installe en terrasse et commande un café. Une séquence courte pour travailler les formules de politesse et les prix.',
      'description' => 'Cette vidéo suit Théo dans un café de quartier. Les apprenants de niveau A2 repèrent les formules figées de la commande, les chiffres et la manière dont on demande l\'addition. Un document idéal avant un jeu de rôle en classe.',
      'objectives' => [
        'Comprendre une commande au café',
        'Reconnaître les formules de politesse',
        'Comprendre un prix et une addition',
      ],
      'transcript' => [
        [
          't' => 0,
          'speaker' => 'Narrateur',
          'text' => 'En France, la terrasse du café est un véritable lieu de vie.',
        ],
        [
          't' => 8,
          'speaker' => 'Serveur',
          'text' => 'Bonjour, qu\'est-ce que je vous sers ?',
        ],
        [
          't' => 13,
          'speaker' => 'Théo',
          'text' => 'Bonjour, je voudrais un café serré, s\'il vous plaît.',
        ],
        [
          't' => 19,
          'speaker' => 'Serveur',
          'text' => 'Très bien. Sur place ou à emporter ?',
        ],
        [
          't' => 23,
          'speaker' => 'Théo',
          'text' => 'Sur place. Et vous avez quelque chose à manger ?',
        ],
        [
          't' => 28,
          'speaker' => 'Serveur',
          'text' => 'Il reste des croissants, c\'est un euro quatre-vingts.',
        ],
        [
          't' => 34,
          'speaker' => 'Théo',
          'text' => 'Parfait, j\'en prends un. Ça fait combien ?',
        ],
        [
          't' => 39,
          'speaker' => 'Serveur',
          'text' => 'Ça vous fera trois euros soixante-dix.',
        ],
        [
          't' => 45,
          'speaker' => 'Théo',
          'text' => 'Je peux payer par carte ?',
        ],
        [
          't' => 49,
          'speaker' => 'Serveur',
          'text' => 'Bien sûr. Voilà votre ticket, bonne journée !',
        ],
        [
          't' => 55,
          'speaker' => 'Théo',
          'text' => 'Merci beaucoup, au revoir !',
        ],
      ],
      'vocabulary' => [
        [
          'term' => 'je voudrais',
          'definition' => 'Formule polie pour demander (conditionnel de politesse).',
          'example' => 'Je voudrais un café, s\'il vous plaît.',
          'category' => 'expression',
        ],
        [
          'term' => 'serré',
          'definition' => 'Se dit d\'un café avec peu d\'eau, au goût fort.',
          'example' => 'Un café serré et bien noir.',
          'category' => 'adjectif',
        ],
        [
          'term' => 'à emporter',
          'definition' => 'Que l\'on emporte, contrairement à « sur place ».',
          'example' => 'Deux sandwichs à emporter.',
          'category' => 'expression',
        ],
        [
          'term' => 'Ça fait combien ?',
          'definition' => 'Question pour demander le prix total.',
          'example' => 'Ça fait combien pour deux ?',
          'category' => 'expression',
        ],
        [
          'term' => 'le ticket de caisse',
          'definition' => 'Petit papier qui indique le détail de l\'achat.',
          'example' => 'Conservez le ticket de caisse.',
          'category' => 'nom',
        ],
      ],
      'teachingSheet' => [
        'durationLabel' => '45 minutes',
        'audienceLabel' => 'Groupe hétérogène A2, adolescents et adultes',
        'materials' => [
          'Vidéo + transcription',
          'Fiche élève imprimable',
          'Cartes de prix factices',
        ],
        'languagePoints' => [
          'Les formules de politesse en situation de service',
          'Les prix et les nombres décimaux',
          'Le conditionnel de politesse (je voudrais / j\'aimerais)',
        ],
        'steps' => [
          [
            'title' => 'Découverte de l\'image',
            'detail' => 'Vidéo sans le son : où sont les personnages ? Que vont-ils dire ?',
            'minutes' => 5,
          ],
          [
            'title' => 'Compréhension globale',
            'detail' => 'Première écoute avec les questions du QCM.',
            'minutes' => 10,
          ],
          [
            'title' => 'Repérage des formules',
            'detail' => 'Texte à trous : réinjection des formules figées.',
            'minutes' => 10,
          ],
          [
            'title' => 'Jeu de rôle',
            'detail' => 'Binômes serveur / client, rotation toutes les 3 minutes.',
            'minutes' => 15,
          ],
          [
            'title' => 'Prolongement',
            'detail' => 'Comparer avec la scène du café dans le pays des apprenants.',
            'minutes' => 5,
          ],
        ],
        'evaluation' => 'Grille simple : prononciation des formules, respect des tours de parole, calcul du prix.',
        'differentiation' => 'Pour les plus rapides : ajouter un problème de monnaie ou une commande à emporter.',
      ],
      'featured' => false,
      'views' => 2841,
      'exercises' => [
        [
          'type' => 'qcm',
          'title' => 'Compréhension globale',
          'instructions' => 'Regardez la vidéo puis choisissez la bonne réponse pour chaque question.',
          'skill' => 'Compréhension orale',
          'explanation' => 'La compréhension globale se travaille d\'abord sans le détail : qui parle, où, et pourquoi ?',
          'payload' => [
            'questions' => [
              [
                'text' => 'Où se passe la scène ?',
                'options' => [
                  [
                    'text' => 'Dans un restaurant gastronomique',
                    'correct' => false,
                    'feedback' => 'Non : il n\'y a pas de carte ni de serveur attitré à table.',
                  ],
                  [
                    'text' => 'En terrasse d\'un café de quartier',
                    'correct' => true,
                    'feedback' => 'Exact : le narrateur parle de la terrasse du café.',
                  ],
                  [
                    'text' => 'Dans un bureau',
                    'correct' => false,
                    'feedback' => 'Non, aucun indice ne renvoie au monde du travail.',
                  ],
                ],
              ],
              [
                'text' => 'Que commande Théo ?',
                'options' => [
                  [
                    'text' => 'Un café serré et un croissant',
                    'correct' => true,
                    'feedback' => 'Oui, plus un euro quatre-vingts pour le croissant.',
                  ],
                  [
                    'text' => 'Un thé et un croissant',
                    'correct' => false,
                    'feedback' => 'Théo ne parle pas de thé.',
                  ],
                  [
                    'text' => 'Deux cafés',
                    'correct' => false,
                    'feedback' => 'Il ne commande qu\'une seule boisson.',
                  ],
                ],
              ],
              [
                'text' => 'Combien Théo doit-il payer ?',
                'options' => [
                  [
                    'text' => '2,10 €',
                    'correct' => false,
                    'feedback' => 'Ce serait trop peu pour les deux articles.',
                  ],
                  [
                    'text' => '3,70 €',
                    'correct' => true,
                    'feedback' => 'Bravo : café + croissant = trois euros soixante-dix.',
                  ],
                  [
                    'text' => '1,80 €',
                    'correct' => false,
                    'feedback' => 'C\'est le prix du croissant seul.',
                  ],
                ],
              ],
              [
                'text' => 'Comment Théo paie-t-il ?',
                'options' => [
                  [
                    'text' => 'En espèces',
                    'correct' => false,
                    'feedback' => 'Non, il pose une question sur un autre moyen de paiement.',
                  ],
                  [
                    'text' => 'Par chèque',
                    'correct' => false,
                    'feedback' => 'Le chèque n\'est pas mentionné.',
                  ],
                  [
                    'text' => 'Par carte bancaire',
                    'correct' => true,
                    'feedback' => 'Exact : « Je peux payer par carte ? »',
                  ],
                ],
              ],
            ],
          ],
        ],
        [
          'type' => 'texte-trous',
          'title' => 'Reconstituer le dialogue',
          'instructions' => 'Complétez les répliques avec les mots manquants. Les majuscules et les accents ne sont pas pénalisés.',
          'skill' => 'Lexique / Interaction',
          'explanation' => 'En français parlé, la politesse repose sur des blocs figés : « bonjour », « je voudrais », « s\'il vous plaît », « merci ».',
          'payload' => [
            'text' => 'Le serveur : « ___ ! Qu\'est-ce que je vous sers ? »
Théo : « Bonjour, ___ un café ___, s\'il vous ___. »
Le serveur : « Sur place ou à ___ ? »
Théo : « ___ fait combien ? »',
            'blanks' => [
              [
                'answers' => [
                  'bonjour',
                ],
                'hint' => 'Salutation (8 lettres)',
                'explanation' => 'On ouvre toujours l\'échange par « Bonjour ».',
              ],
              [
                'answers' => [
                  'je voudrais',
                  'j\'aimerais',
                ],
                'hint' => 'Conditionnel de politesse',
                'explanation' => '« Je voudrais » est plus poli que « je veux ».',
              ],
              [
                'answers' => [
                  'serre',
                  'serré',
                ],
                'hint' => 'Adjectif : peu d\'eau',
                'explanation' => '« Serré » décrit un café au goût fort.',
              ],
              [
                'answers' => [
                  'plait',
                  'plaît',
                ],
                'hint' => 'Il vous…',
                'explanation' => '« S\'il vous plaît » est la formule de politesse de base.',
              ],
              [
                'answers' => [
                  'emporter',
                ],
                'hint' => 'Contraire de « sur place »',
                'explanation' => '« À emporter » = on prend la nourriture avec soi.',
              ],
              [
                'answers' => [
                  'ca',
                ],
                'hint' => 'Expression de 4 lettres, sans accent',
                'explanation' => '« Ça fait combien ? » demande le prix total.',
              ],
            ],
            'wordBank' => [
              'Bonjour',
              'je voudrais',
              'serré',
              'plaît',
              'emporter',
              'Ça',
            ],
          ],
        ],
        [
          'type' => 'glisser-deposer',
          'title' => 'Au café ou au restaurant ?',
          'instructions' => 'Glissez chaque élément dans la bonne catégorie. Accessible au clavier : sélectionnez un élément, puis choisissez une colonne.',
          'skill' => 'Vocabulaire',
          'explanation' => 'Le café et le restaurant n\'ont pas les mêmes usages : le service, les horaires et l\'addition diffèrent.',
          'payload' => [
            'categories' => [
              [
                'id' => 'cafe',
                'label' => 'Au café',
                'hint' => 'Boissons, comptoir, terrasse',
              ],
              [
                'id' => 'restaurant',
                'label' => 'Au restaurant',
                'hint' => 'Menu, plat, réservation',
              ],
            ],
            'items' => [
              [
                'id' => 'i1',
                'text' => 'un expresso',
                'categoryId' => 'cafe',
              ],
              [
                'id' => 'i2',
                'text' => 'réserver une table',
                'categoryId' => 'restaurant',
              ],
              [
                'id' => 'i3',
                'text' => 'la carte des boissons',
                'categoryId' => 'cafe',
              ],
              [
                'id' => 'i4',
                'text' => 'le menu du jour',
                'categoryId' => 'restaurant',
              ],
              [
                'id' => 'i5',
                'text' => 'l\'addition sur le comptoir',
                'categoryId' => 'cafe',
              ],
              [
                'id' => 'i6',
                'text' => 'une entrée et un plat',
                'categoryId' => 'restaurant',
              ],
              [
                'id' => 'i7',
                'text' => 'le serveur de terrasse',
                'categoryId' => 'cafe',
              ],
              [
                'id' => 'i8',
                'text' => 'le pourboire',
                'categoryId' => 'restaurant',
              ],
            ],
          ],
        ],
      ],
    ],
    [
      'slug' => 'premiers-mots-a-paris',
      'title' => 'Premiers mots à Paris',
      'subtitle' => 'Saluer, se présenter, dire où l\'on va',
      'level' => 'A1',
      'theme' => 'vocabulaire',
      'audience' => 'apprenants',
      'mediaType' => 'video',
      'mediaUrl' => 'https://videos.pexels.com/video-files/32757192/13965008_3840_2160_25fps.mp4',
      'posterUrl' => 'https://images.pexels.com/videos/32757192/book-lovers-france-paris-paris-france-32757192.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=630&w=1200',
      'durationLabel' => '1 min 30',
      'durationSeconds' => 90,
      'excerpt' => 'Une promenade visuelle et sonore pour découvrir les premières formules de la langue : bonjour, je m\'appelle, je vais à…',
      'description' => 'Séquence d\'initiation conçue pour les grands débutants. Les images d\'une ville francophone servent de support à la découverte des formules de salutation, des présentations simples et des nombres de 0 à 20.',
      'objectives' => [
        'Saluer et prendre congé',
        'Dire son nom et sa nationalité',
        'Compter jusqu\'à vingt',
      ],
      'transcript' => [
        [
          't' => 0,
          'speaker' => 'Voix 1',
          'text' => 'Bonjour ! Comment tu t\'appelles ?',
        ],
        [
          't' => 6,
          'speaker' => 'Voix 2',
          'text' => 'Je m\'appelle Awa, et toi ?',
        ],
        [
          't' => 11,
          'speaker' => 'Voix 1',
          'text' => 'Moi, c\'est Léo. Tu viens d\'où ?',
        ],
        [
          't' => 16,
          'speaker' => 'Voix 2',
          'text' => 'Je viens du Sénégal. J\'habite à Dakar.',
        ],
        [
          't' => 22,
          'speaker' => 'Voix 1',
          'text' => 'Tu es étudiante ?',
        ],
        [
          't' => 26,
          'speaker' => 'Voix 2',
          'text' => 'Oui, j\'étudie le français. Un, deux, trois… je compte !',
        ],
        [
          't' => 34,
          'speaker' => 'Voix 1',
          'text' => 'Très bien ! À bientôt, Awa.',
        ],
        [
          't' => 39,
          'speaker' => 'Voix 2',
          'text' => 'Au revoir et merci !',
        ],
      ],
      'vocabulary' => [
        [
          'term' => 'Je m\'appelle…',
          'definition' => 'Formule pour dire son nom.',
          'example' => 'Je m\'appelle Awa.',
          'category' => 'expression',
        ],
        [
          'term' => 'tu viens d\'où ?',
          'definition' => 'Question sur l\'origine.',
          'example' => 'Tu viens d\'où ? — Du Maroc.',
          'category' => 'expression',
        ],
        [
          'term' => 'habiter',
          'definition' => 'Résider dans un lieu.',
          'example' => 'J\'habite à Lyon.',
          'category' => 'verbe',
        ],
        [
          'term' => 'étudiant(e)',
          'definition' => 'Personne qui étudie dans une école ou une université.',
          'example' => 'Elle est étudiante en lettres.',
          'category' => 'nom',
        ],
        [
          'term' => 'à bientôt',
          'definition' => 'Formule pour dire au revoir quand on reverra la personne.',
          'example' => 'À bientôt, bonne journée !',
          'category' => 'expression',
        ],
      ],
      'teachingSheet' => [
        'durationLabel' => '30 minutes',
        'audienceLabel' => 'Vrais débutants A1.1',
        'materials' => [
          'Vidéo muette',
          'Cartes-image',
          'Fiche élève',
        ],
        'languagePoints' => [
          'Les pronoms tu / je',
          'Les verbes s\'appeler, venir, habiter',
          'Les nombres 0-20',
        ],
        'steps' => [
          [
            'title' => 'Silence et images',
            'detail' => 'Les apprenants nomment ce qu\'ils voient avec les mots qu\'ils connaissent.',
            'minutes' => 5,
          ],
          [
            'title' => 'Écoute guidée',
            'detail' => 'Répéter chaque réplique en chœur, puis en binôme.',
            'minutes' => 10,
          ],
          [
            'title' => 'Chaîne de présentations',
            'detail' => 'Chaque apprenant se présente, puis présente son voisin.',
            'minutes' => 10,
          ],
          [
            'title' => 'Clôture',
            'detail' => 'Comptage collectif de 0 à 20 en frappant dans les mains.',
            'minutes' => 5,
          ],
        ],
        'evaluation' => 'Cochez : se présente / dit son origine / salue correctement.',
        'differentiation' => 'Écrire les prénoms au tableau pour soutenir la mémorisation auditive.',
      ],
      'featured' => false,
      'views' => 5109,
      'exercises' => [
        [
          'type' => 'qcm',
          'title' => 'Repérer l\'essentiel',
          'instructions' => 'Écoutez puis répondez. Une seule réponse est correcte.',
          'skill' => 'Compréhension orale',
          'explanation' => 'À ce niveau, on s\'appuie sur les mots transparents et les intonations.',
          'payload' => [
            'questions' => [
              [
                'text' => 'Comment s\'appelle la jeune femme ?',
                'options' => [
                  [
                    'text' => 'Léo',
                    'correct' => false,
                    'feedback' => 'Léo est l\'autre personnage.',
                  ],
                  [
                    'text' => 'Awa',
                    'correct' => true,
                    'feedback' => 'Oui : « Je m\'appelle Awa ».',
                  ],
                  [
                    'text' => 'Marie',
                    'correct' => false,
                    'feedback' => 'Ce prénom n\'est pas prononcé.',
                  ],
                ],
              ],
              [
                'text' => 'D\'où vient Awa ?',
                'options' => [
                  [
                    'text' => 'Du Sénégal',
                    'correct' => true,
                    'feedback' => 'Exact : « Je viens du Sénégal ».',
                  ],
                  [
                    'text' => 'Du Maroc',
                    'correct' => false,
                    'feedback' => 'Non, ce pays n\'est pas cité.',
                  ],
                  [
                    'text' => 'De Belgique',
                    'correct' => false,
                    'feedback' => 'Non.',
                  ],
                ],
              ],
              [
                'text' => 'Quel est son métier ?',
                'options' => [
                  [
                    'text' => 'Elle est serveuse',
                    'correct' => false,
                    'feedback' => 'Non, elle étudie.',
                  ],
                  [
                    'text' => 'Elle est étudiante',
                    'correct' => true,
                    'feedback' => 'Bravo : « Oui, j\'étudie le français ».',
                  ],
                  [
                    'text' => 'Elle est professeure',
                    'correct' => false,
                    'feedback' => 'Non.',
                  ],
                ],
              ],
            ],
          ],
        ],
        [
          'type' => 'reordonner',
          'title' => 'Remettre le dialogue dans l\'ordre',
          'instructions' => 'Cliquez sur les répliques pour les placer dans l\'ordre chronologique, ou utilisez les flèches.',
          'skill' => 'Cohérence des échanges',
          'explanation' => 'Un échange suit une logique : salutation → question → réponse → prise de congé.',
          'payload' => [
            'items' => [
              [
                'id' => 'a',
                'text' => 'Bonjour ! Comment tu t\'appelles ?',
              ],
              [
                'id' => 'b',
                'text' => 'Je m\'appelle Awa, et toi ?',
              ],
              [
                'id' => 'c',
                'text' => 'Tu viens d\'où ?',
              ],
              [
                'id' => 'd',
                'text' => 'Je viens du Sénégal.',
              ],
              [
                'id' => 'e',
                'text' => 'À bientôt !',
              ],
            ],
            'explanation' => 'Ordre attendu : salutation, présentation, question sur l\'origine, réponse, congé.',
          ],
        ],
      ],
    ],
    [
      'slug' => 'dakar-ville-de-mots',
      'title' => 'Dakar, ville de mots',
      'subtitle' => 'Le français, langue de la rue et des familles au Sénégal',
      'level' => 'B1',
      'theme' => 'francophonie',
      'audience' => 'tous',
      'mediaType' => 'video',
      'mediaUrl' => 'https://videos.pexels.com/video-files/32757190/13965026_3840_2160_24fps.mp4',
      'posterUrl' => 'https://images.pexels.com/photos/37904482/pexels-photo-37904482.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200',
      'durationLabel' => '3 min 20',
      'durationSeconds' => 200,
      'excerpt' => 'Reportage sur la vitalité du français à Dakar : emprunts au wolof, argot des jeunes, radio et affichage urbain.',
      'description' => 'Un reportage qui interroge les habitants de Dakar sur leurs pratiques langagières. On y découvre l\'alternance codique français / wolof, le rôle de la radio et la créativité lexicale des jeunes urbains. Idéal pour aborder la francophonie comme espace pluriel.',
      'objectives' => [
        'Identifier des opinions sur une langue',
        'Comprendre un reportage de terrain',
        'Décrire des pratiques langagières',
      ],
      'transcript' => [
        [
          't' => 0,
          'speaker' => 'Journaliste',
          'text' => 'À Dakar, on passe d\'une langue à l\'autre sans y penser.',
        ],
        [
          't' => 9,
          'speaker' => 'Aminata, vendeuse',
          'text' => 'Je parle wolof à la maison et français au travail.',
        ],
        [
          't' => 17,
          'speaker' => 'Journaliste',
          'text' => 'Et avec vos enfants ?',
        ],
        [
          't' => 20,
          'speaker' => 'Aminata',
          'text' => 'Avec les enfants, on mélange : c\'est plus rapide !',
        ],
        [
          't' => 27,
          'speaker' => 'Moussa, étudiant',
          'text' => 'Le français, c\'est la langue de l\'école, mais l\'argot appartient à la rue.',
        ],
        [
          't' => 38,
          'speaker' => 'Journaliste',
          'text' => 'Créez-vous des mots nouveaux ?',
        ],
        [
          't' => 42,
          'speaker' => 'Moussa',
          'text' => 'Tout le temps. On emprunte au wolof, on déforme, on invente.',
        ],
        [
          't' => 52,
          'speaker' => 'Pr. Diop, linguiste',
          'text' => 'Cette créativité n\'appauvrit pas la langue : elle la déplace, elle la renouvelle.',
        ],
        [
          't' => 65,
          'speaker' => 'Journaliste',
          'text' => 'Sur les murs de la ville, le français côtoie les langues nationales.',
        ],
        [
          't' => 74,
          'speaker' => 'Pr. Diop',
          'text' => 'Une langue vivante, c\'est une langue qui change avec ceux qui la parlent.',
        ],
      ],
      'vocabulary' => [
        [
          'term' => 'l\'alternance codique',
          'definition' => 'Passage d\'une langue à l\'autre dans le même discours.',
          'example' => 'L\'alternance codique est fréquente à Dakar.',
          'category' => 'nom',
        ],
        [
          'term' => 'emprunter',
          'definition' => 'Prendre un mot à une autre langue.',
          'example' => 'On emprunte souvent des mots à l\'anglais.',
          'category' => 'verbe',
        ],
        [
          'term' => 'l\'argot',
          'definition' => 'Langue familière d\'un groupe social.',
          'example' => 'L\'argot des jeunes évolue vite.',
          'category' => 'nom',
        ],
        [
          'term' => 'détruire / renouveler',
          'definition' => 'Renouveler : rendre nouveau.',
          'example' => 'Les usages renouvellent la langue.',
          'category' => 'verbe',
        ],
        [
          'term' => 'une langue nationale',
          'definition' => 'Langue reconnue officiellement dans un pays.',
          'example' => 'Le wolof est une langue nationale du Sénégal.',
          'category' => 'expression',
        ],
      ],
      'teachingSheet' => [
        'durationLabel' => '1 h 30',
        'audienceLabel' => 'Classe B1 multilingue',
        'materials' => [
          'Reportage',
          'Dictaphone du téléphone',
          'Carte de la francophonie',
        ],
        'languagePoints' => [
          'Le discours rapporté (il dit que / elle explique que)',
          'L\'expression de l\'opinion (à mon avis, je trouve que)',
          'Le lexique du contact des langues',
        ],
        'steps' => [
          [
            'title' => 'Carte mentale',
            'detail' => 'Quelles langues parle-t-on dans la classe ? On construit une affiche.',
            'minutes' => 15,
          ],
          [
            'title' => 'Écoute séquencée',
            'detail' => 'Visionnage par intervenant, avec prise de notes en tableau.',
            'minutes' => 25,
          ],
          [
            'title' => 'Micro-trottoir',
            'detail' => 'Les apprenants préparent 3 questions et interviewent un camarade.',
            'minutes' => 30,
          ],
          [
            'title' => 'Synthèse écrite',
            'detail' => 'Rédiger 120 mots : « Quelle langue pour la rue, quelle langue pour l\'école ? »',
            'minutes' => 20,
          ],
        ],
        'evaluation' => 'Production orale continue de 2 minutes notée sur la richesse lexicale.',
        'differentiation' => 'Proposer la transcription aux apprenants qui en ont besoin.',
      ],
      'featured' => true,
      'views' => 8723,
      'exercises' => [
        [
          'type' => 'qcm',
          'title' => 'Qui dit quoi ?',
          'instructions' => 'Associez chaque opinion à son intervenant en choisissant la bonne réponse.',
          'skill' => 'Compréhension orale',
          'explanation' => 'Repérer la source d\'un propos est la compétence clé du niveau B1.',
          'payload' => [
            'questions' => [
              [
                'text' => 'Quelle est la position du linguiste ?',
                'options' => [
                  [
                    'text' => 'Le mélange des langues appauvrit le français',
                    'correct' => false,
                    'feedback' => 'C\'est l\'inverse de son propos.',
                  ],
                  [
                    'text' => 'Le mélange des langues renouvelle la langue',
                    'correct' => true,
                    'feedback' => 'Oui : « elle la renouvelle ».',
                  ],
                  [
                    'text' => 'Il faut interdire l\'argot',
                    'correct' => false,
                    'feedback' => 'Aucune normativité dans son discours.',
                  ],
                ],
              ],
              [
                'text' => 'Pourquoi Aminata mélange-t-elle les langues avec ses enfants ?',
                'options' => [
                  [
                    'text' => 'Pour que le français disparaisse',
                    'correct' => false,
                    'feedback' => 'Non, elle parle d\'efficacité.',
                  ],
                  [
                    'text' => 'Parce que c\'est plus rapide',
                    'correct' => true,
                    'feedback' => 'Exact.',
                  ],
                  [
                    'text' => 'Parce que l\'école l\'exige',
                    'correct' => false,
                    'feedback' => 'L\'école n\'est pas mentionnée ici.',
                  ],
                ],
              ],
              [
                'text' => 'Quelle image du français le reportage donne-t-il ?',
                'options' => [
                  [
                    'text' => 'Une langue figée et scolaire',
                    'correct' => false,
                    'feedback' => 'Le reportage montre au contraire une langue en mouvement.',
                  ],
                  [
                    'text' => 'Une langue vivante et créative',
                    'correct' => true,
                    'feedback' => 'C\'est bien le fil conducteur du reportage.',
                  ],
                  [
                    'text' => 'Une langue menacée de disparition',
                    'correct' => false,
                    'feedback' => 'Ce n\'est pas le propos.',
                  ],
                ],
              ],
            ],
          ],
        ],
        [
          'type' => 'glisser-deposer',
          'title' => 'Registres et contextes d\'usage',
          'instructions' => 'Placez chaque situation dans le registre correspondant. Astuce clavier : cliquez un élément, puis cliquez une colonne.',
          'skill' => 'Sociolinguistique',
          'explanation' => 'Un locuteur change de registre selon le lieu, l\'interlocuteur et l\'objectif de communication.',
          'payload' => [
            'categories' => [
              [
                'id' => 'famille',
                'label' => 'Sphère familière',
                'hint' => 'Maison, amis, rue',
              ],
              [
                'id' => 'formelle',
                'label' => 'Sphère formelle',
                'hint' => 'École, administration, travail',
              ],
            ],
            'items' => [
              [
                'id' => 'd1',
                'text' => 'Parler wolof à la maison',
                'categoryId' => 'famille',
              ],
              [
                'id' => 'd2',
                'text' => 'Rédiger une lettre officielle',
                'categoryId' => 'formelle',
              ],
              [
                'id' => 'd3',
                'text' => 'L\'argot des jeunes',
                'categoryId' => 'famille',
              ],
              [
                'id' => 'd4',
                'text' => 'Un exposé à l\'université',
                'categoryId' => 'formelle',
              ],
              [
                'id' => 'd5',
                'text' => 'Les affiches peintes dans la rue',
                'categoryId' => 'famille',
              ],
              [
                'id' => 'd6',
                'text' => 'Un bulletin scolaire',
                'categoryId' => 'formelle',
              ],
            ],
          ],
        ],
        [
          'type' => 'reordonner',
          'title' => 'Reconstruire le propos du linguiste',
          'instructions' => 'Réordonnez les segments pour former une phrase cohérente et correcte.',
          'skill' => 'Syntaxe',
          'explanation' => 'En français, l\'ordre canonique est sujet – verbe – compléments, avec les connecteurs en tête.',
          'payload' => [
            'items' => [
              [
                'id' => 's1',
                'text' => 'Une langue vivante,',
              ],
              [
                'id' => 's2',
                'text' => 'c\'est une langue',
              ],
              [
                'id' => 's3',
                'text' => 'qui change',
              ],
              [
                'id' => 's4',
                'text' => 'avec ceux',
              ],
              [
                'id' => 's5',
                'text' => 'qui la parlent.',
              ],
            ],
            'explanation' => 'La relative en « qui » suit immédiatement son antécédent.',
          ],
        ],
      ],
    ],
    [
      'slug' => 'lire-a-lheure-du-numerique',
      'title' => 'Lire à l\'heure du numérique',
      'subtitle' => 'Le livre papier face aux écrans : un débat de société',
      'level' => 'B2',
      'theme' => 'litterature',
      'audience' => 'tous',
      'mediaType' => 'video',
      'mediaUrl' => 'https://videos.pexels.com/video-files/28344954/12363395_1920_1080_30fps.mp4',
      'posterUrl' => 'https://images.pexels.com/photos/38019365/pexels-photo-38019365.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200',
      'durationLabel' => '4 min 05',
      'durationSeconds' => 245,
      'excerpt' => 'Éditeurs, libraires et lecteurs débattent de la place du livre papier à l\'ère des liseuses et des lectures verticales.',
      'description' => 'Ce document argumentatif met en scène des points de vue contradictoires sur la lecture numérique. Il permet de travailler l\'implicite, les connecteurs argumentatifs et la reformulation, compétences attendues au niveau B2.',
      'objectives' => [
        'Suivre un débat argumenté',
        'Repérer les connecteurs logiques',
        'Formuler une opinion nuancée',
      ],
      'transcript' => [
        [
          't' => 0,
          'speaker' => 'Animatrice',
          'text' => 'Le livre papier est-il condamné ? C\'est notre question du soir.',
        ],
        [
          't' => 10,
          'speaker' => 'Éditrice',
          'text' => 'Les ventes se sont stabilisées. Le papier n\'a pas disparu, il s\'est repositionné.',
        ],
        [
          't' => 23,
          'speaker' => 'Animatrice',
          'text' => 'Repositionné, c\'est-à-dire ?',
        ],
        [
          't' => 26,
          'speaker' => 'Éditrice',
          'text' => 'On achète moins, mais on achète mieux : des beaux livres, des objets.',
        ],
        [
          't' => 37,
          'speaker' => 'Libraire',
          'text' => 'En revanche, la fréquentation de ma boutique a changé de rythme.',
        ],
        [
          't' => 48,
          'speaker' => 'Libraire',
          'text' => 'Les gens viennent moins souvent, mais ils restent plus longtemps.',
        ],
        [
          't' => 59,
          'speaker' => 'Sociologue',
          'text' => 'Il faut distinguer support et pratique. Lire sur écran n\'est pas lire moins.',
        ],
        [
          't' => 72,
          'speaker' => 'Sociologue',
          'text' => 'Ce qui change, c\'est l\'attention : elle devient plus fragmentée.',
        ],
        [
          't' => 84,
          'speaker' => 'Animatrice',
          'text' => 'Alors, faut-il s\'inquiéter ?',
        ],
        [
          't' => 88,
          'speaker' => 'Sociologue',
          'text' => 'Je dirais qu\'il faut surtout former : apprendre à lire longuement, c\'est un apprentissage.',
        ],
        [
          't' => 100,
          'speaker' => 'Éditrice',
          'text' => 'Et c\'est exactement pour cela que la librairie garde son rôle social.',
        ],
      ],
      'vocabulary' => [
        [
          'term' => 'se repositionner',
          'definition' => 'Changer de place ou de rôle dans un marché.',
          'example' => 'Le livre papier s\'est repositionné.',
          'category' => 'verbe',
        ],
        [
          'term' => 'en revanche',
          'definition' => 'Connecteur qui introduit une opposition.',
          'example' => 'Je lis peu ; en revanche, j\'écoute beaucoup.',
          'category' => 'expression',
        ],
        [
          'term' => 'distinguer',
          'definition' => 'Séparer deux notions pour ne pas les confondre.',
          'example' => 'Il faut distinguer support et pratique.',
          'category' => 'verbe',
        ],
        [
          'term' => 'fragmenté',
          'definition' => 'Découpé en petits morceaux, non continu.',
          'example' => 'Une attention fragmentée.',
          'category' => 'adjectif',
        ],
        [
          'term' => 's\'inquiéter',
          'definition' => 'Éprouver de l\'inquiétude, se poser des questions.',
          'example' => 'Faut-il s\'inquiéter de cette évolution ?',
          'category' => 'verbe',
        ],
      ],
      'teachingSheet' => [
        'durationLabel' => '2 h',
        'audienceLabel' => 'B2 / préparation DELF B2',
        'materials' => [
          'Vidéo',
          'Corpus d\'articles courts',
          'Grille d\'argumentation',
        ],
        'languagePoints' => [
          'Les connecteurs argumentatifs (en revanche, cependant, dès lors)',
          'Le conditionnel journalistique',
          'La reformulation et l\'implicite',
        ],
        'steps' => [
          [
            'title' => 'Débat chaise vide',
            'detail' => 'Deux camps : « le livre est mort » / « le livre renaît ». 5 minutes de préparation.',
            'minutes' => 25,
          ],
          [
            'title' => 'Écoute du document',
            'detail' => 'Repérer qui défend quoi ; remplir un tableau argument / exemple.',
            'minutes' => 30,
          ],
          [
            'title' => 'Atelier connecteurs',
            'detail' => 'Réécrire un paragraphe en variant les connecteurs.',
            'minutes' => 30,
          ],
          [
            'title' => 'Essai argumenté',
            'detail' => '250 mots : « Lire longuement s\'apprend-il ? »',
            'minutes' => 35,
          ],
        ],
        'evaluation' => 'Grille DELF B2 : pertinence, cohérence, lexique, correction.',
        'differentiation' => 'Fournir les transcriptions pour un travail sur les hésitations du débat.',
      ],
      'featured' => false,
      'views' => 4310,
      'exercises' => [
        [
          'type' => 'qcm',
          'title' => 'Nuances et implicite',
          'instructions' => 'Choisissez la réponse la plus fidèle au document.',
          'skill' => 'Compréhension de l\'implicite',
          'explanation' => 'Au B2, on évalue non seulement ce qui est dit, mais ce qui est sous-entendu.',
          'payload' => [
            'questions' => [
              [
                'text' => 'Que sous-entend l\'éditrice par « on achète mieux » ?',
                'options' => [
                  [
                    'text' => 'Les livres sont moins chers',
                    'correct' => false,
                    'feedback' => 'Elle ne parle pas de prix.',
                  ],
                  [
                    'text' => 'Les achats sont plus réfléchis et qualitatifs',
                    'correct' => true,
                    'feedback' => 'Oui, elle cite les beaux livres et les objets.',
                  ],
                  [
                    'text' => 'Les lecteurs lisent plus vite',
                    'correct' => false,
                    'feedback' => 'Hors sujet.',
                  ],
                ],
              ],
              [
                'text' => 'Quelle distinction le sociologue propose-t-il ?',
                'options' => [
                  [
                    'text' => 'Entre support et pratique de lecture',
                    'correct' => true,
                    'feedback' => 'Exact : « distinguer support et pratique ».',
                  ],
                  [
                    'text' => 'Entre roman et essai',
                    'correct' => false,
                    'feedback' => 'Non, il ne parle pas de genres.',
                  ],
                  [
                    'text' => 'Entre librairie et supermarché',
                    'correct' => false,
                    'feedback' => 'Non.',
                  ],
                ],
              ],
              [
                'text' => 'Quelle est la conclusion implicite du débat ?',
                'options' => [
                  [
                    'text' => 'Le numérique doit être interdit',
                    'correct' => false,
                    'feedback' => 'Personne ne le propose.',
                  ],
                  [
                    'text' => 'Les deux formes de lecture sont complémentaires',
                    'correct' => true,
                    'feedback' => 'C\'est le consensus qui se dessine.',
                  ],
                  [
                    'text' => 'La librairie est condamnée',
                    'correct' => false,
                    'feedback' => 'Au contraire, on lui reconnaît un rôle social.',
                  ],
                ],
              ],
            ],
          ],
        ],
        [
          'type' => 'texte-trous',
          'title' => 'Connecteurs argumentatifs',
          'instructions' => 'Complétez le résumé avec les connecteurs manquants tirés du document.',
          'skill' => 'Cohésion textuelle',
          'explanation' => 'Les connecteurs organisent l\'argumentation : opposition, cause, conséquence.',
          'payload' => [
            'text' => 'Les ventes de livres papier ont diminué, ___ elles ne se sont pas effondrées. ___ , la librairie a changé de rythme : les clients viennent moins souvent, ___ ils restent plus longtemps. ___ distinguer le support et la pratique : lire sur écran n\'est pas lire moins, ___ l\'attention se fragmente.',
            'blanks' => [
              [
                'answers' => [
                  'mais',
                ],
                'hint' => 'Opposition, 4 lettres',
                'explanation' => '« Mais » introduit une concession.',
              ],
              [
                'answers' => [
                  'en revanche',
                  'revanche',
                ],
                'hint' => 'Opposition (3 mots)',
                'explanation' => '« En revanche » marque un contraste.',
              ],
              [
                'answers' => [
                  'mais',
                  'pourtant',
                ],
                'hint' => 'Concession',
                'explanation' => 'On peut aussi utiliser « toutefois ».',
              ],
              [
                'answers' => [
                  'il faut',
                  'ilfaut',
                ],
                'hint' => 'Impersonnel + devoir',
                'explanation' => '« Il faut distinguer… » introduit une condition d\'analyse.',
              ],
              [
                'answers' => [
                  'cependant',
                  'toutefois',
                  'neanmoins',
                  'néanmoins',
                ],
                'hint' => 'Concession, 9 lettres',
                'explanation' => '« Cependant » nuance l\'affirmation précédente.',
              ],
            ],
            'wordBank' => [
              'mais',
              'en revanche',
              'pourtant',
              'Il faut',
              'cependant',
            ],
          ],
        ],
        [
          'type' => 'reordonner',
          'title' => 'Reconstruire une phrase complexe',
          'instructions' => 'Réordonnez les segments pour obtenir une phrase correcte et fluide.',
          'skill' => 'Syntaxe complexe',
          'explanation' => 'La concession peut s\'exprimer par « bien que + subjonctif ».',
          'payload' => [
            'items' => [
              [
                'id' => 'o1',
                'text' => 'Bien que les écrans',
              ],
              [
                'id' => 'o2',
                'text' => 'se soient imposés',
              ],
              [
                'id' => 'o3',
                'text' => 'dans nos pratiques,',
              ],
              [
                'id' => 'o4',
                'text' => 'le livre papier',
              ],
              [
                'id' => 'o5',
                'text' => 'conserve une valeur symbolique.',
              ],
            ],
            'explanation' => '« Bien que » est suivi du subjonctif : « se soient imposés ».',
          ],
        ],
      ],
    ],
    [
      'slug' => 'le-journal-du-matin',
      'title' => 'Le journal du matin, décrypté',
      'subtitle' => 'Comment l\'info est fabriquée, hiérarchisée et commentée',
      'level' => 'B2',
      'theme' => 'actualite',
      'audience' => 'tous',
      'mediaType' => 'video',
      'mediaUrl' => 'https://videos.pexels.com/video-files/28344954/12363395_1920_1080_30fps.mp4',
      'posterUrl' => 'https://images.pexels.com/photos/9159037/pexels-photo-9159037.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200',
      'durationLabel' => '3 min 40',
      'durationSeconds' => 220,
      'excerpt' => 'Dans les coulisses d\'une rédaction : hiérarchie de l\'information, faits et commentaires, pièges des titres.',
      'description' => 'Une plongée dans une rédaction pour comprendre comment l\'information est sélectionnée. Les apprenants apprennent à distinguer un fait d\'un commentaire, à repérer les temps verbaux du titre et à analyser un une-à-une.',
      'objectives' => [
        'Distinguer fait et commentaire',
        'Comprendre les temps de l\'écrit journalistique',
        'Analyser la hiérarchie de l\'information',
      ],
      'transcript' => [
        [
          't' => 0,
          'speaker' => 'Rédacteur en chef',
          'text' => 'Chaque matin, on choisit : trois informations fortes, pas quinze.',
        ],
        [
          't' => 11,
          'speaker' => 'Journaliste',
          'text' => 'Un titre doit dire un fait, pas une opinion.',
        ],
        [
          't' => 19,
          'speaker' => 'Rédacteur en chef',
          'text' => 'D\'où l\'usage du présent : « le gouvernement annonce ».',
        ],
        [
          't' => 28,
          'speaker' => 'Journaliste',
          'text' => 'Et le passé composé pour l\'événement déjà terminé.',
        ],
        [
          't' => 36,
          'speaker' => 'Rédactrice',
          'text' => 'Attention aux chiffres : un pourcentage sans comparaison ne veut rien dire.',
        ],
        [
          't' => 47,
          'speaker' => 'Journaliste',
          'text' => 'On vérifie toujours la source, sinon on ne publie pas.',
        ],
        [
          't' => 56,
          'speaker' => 'Rédacteur en chef',
          'text' => 'Le commentaire, lui, va dans l\'éditorial, jamais dans la brève.',
        ],
      ],
      'vocabulary' => [
        [
          'term' => 'la une',
          'definition' => 'Première page d\'un journal.',
          'example' => 'La une de ce matin fait la storm.',
          'category' => 'nom',
        ],
        [
          'term' => 'une brève',
          'definition' => 'Information très courte, sans analyse.',
          'example' => 'Trois brèves en ouverture.',
          'category' => 'nom',
        ],
        [
          'term' => 'l\'éditorial',
          'definition' => 'Article d\'opinion signé par la rédaction.',
          'example' => 'L\'éditorial du jour porte sur l\'énergie.',
          'category' => 'nom',
        ],
        [
          'term' => 'vérifier une source',
          'definition' => 'Contrôler l\'origine d\'une information.',
          'example' => 'La source n\'est pas fiable, on ne publie pas.',
          'category' => 'expression',
        ],
        [
          'term' => 'hiérarchiser',
          'definition' => 'Classer par ordre d\'importance.',
          'example' => 'Il faut hiérarchiser les informations.',
          'category' => 'verbe',
        ],
      ],
      'teachingSheet' => [
        'durationLabel' => '1 h 30',
        'audienceLabel' => 'B2, classe ou atelier médias',
        'materials' => [
          'Vidéo',
          'Un quotidien du jour',
          'Surligneurs',
        ],
        'languagePoints' => [
          'Présent et passé composé de l\'écrit journalistique',
          'La voix passive',
          'Le lexique des médias',
        ],
        'steps' => [
          [
            'title' => 'Une-à-une',
            'detail' => 'Analyser la une d\'un quotidien : que montre la photo ? quel titre ?',
            'minutes' => 20,
          ],
          [
            'title' => 'Vidéo',
            'detail' => 'Repérer les règles énoncées par les journalistes.',
            'minutes' => 25,
          ],
          [
            'title' => 'Atelier rédaction',
            'detail' => 'Écrire une brève de 40 mots à partir d\'un fait simple.',
            'minutes' => 30,
          ],
          [
            'title' => 'Fact-checking',
            'detail' => 'Vérifier une information en binôme : source, date, chiffres.',
            'minutes' => 15,
          ],
        ],
        'evaluation' => 'La brève est validée si elle contient un fait, une date et une source.',
        'differentiation' => 'Fournir une trame de brève à trous pour les profils fragiles.',
      ],
      'featured' => false,
      'views' => 3120,
      'exercises' => [
        [
          'type' => 'texte-trous',
          'title' => 'Les temps de l\'écrit journalistique',
          'instructions' => 'Conjuguez les verbes entre parenthèses comme le voudrait un titre de presse.',
          'skill' => 'Grammaire',
          'explanation' => 'Le titre utilise le présent de l\'indicatif pour l\'actualité et le passé composé pour l\'événement achevé.',
          'payload' => [
            'text' => 'Le gouvernement ___ (annoncer) un plan logement. Hier, la ministre ___ (présenter) le dispositif. Elle ___ (préciser) que les aides ___ (être) réévaluées. La rédaction ___ (publier) sa brève à 6 h 30.',
            'blanks' => [
              [
                'answers' => [
                  'annonce',
                ],
                'hint' => 'Présent, 3e personne du singulier',
                'explanation' => 'Titre au présent : « le gouvernement annonce ».',
              ],
              [
                'answers' => [
                  'a présenté',
                  'a presente',
                ],
                'hint' => 'Passé composé',
                'explanation' => '« Hier » impose le passé composé.',
              ],
              [
                'answers' => [
                  'a précisé',
                  'a precise',
                ],
                'hint' => 'Passé composé',
                'explanation' => 'Même logique : action achevée.',
              ],
              [
                'answers' => [
                  'étaient',
                  'etaient',
                  'sont',
                ],
                'hint' => 'Accord au pluriel',
                'explanation' => '« Les aides » : imparfait ou présent selon la perspective.',
              ],
              [
                'answers' => [
                  'publie',
                ],
                'hint' => 'Présent',
                'explanation' => 'Le présent convient à une règle de fonctionnement.',
              ],
            ],
            'wordBank' => [
              'annonce',
              'a présenté',
              'a précisé',
              'étaient',
              'publie',
            ],
          ],
        ],
        [
          'type' => 'glisser-deposer',
          'title' => 'Fait ou commentaire ?',
          'instructions' => 'Classez chaque phrase : information vérifiable ou prise de position.',
          'skill' => 'Éducation aux médias',
          'explanation' => 'Un fait est datable et vérifiable ; un commentaire exprime une évaluation.',
          'payload' => [
            'categories' => [
              [
                'id' => 'fait',
                'label' => 'Fait',
                'hint' => 'Vérifiable, daté',
              ],
              [
                'id' => 'avis',
                'label' => 'Commentaire',
                'hint' => 'Jugement, adjectif évaluatif',
              ],
            ],
            'items' => [
              [
                'id' => 'f1',
                'text' => 'Le conseil municipal s\'est réuni lundi.',
                'categoryId' => 'fait',
              ],
              [
                'id' => 'f2',
                'text' => 'Cette décision est catastrophique.',
                'categoryId' => 'avis',
              ],
              [
                'id' => 'f3',
                'text' => 'Le chômage recule de 0,3 %.',
                'categoryId' => 'fait',
              ],
              [
                'id' => 'f4',
                'text' => 'Un excellent choix pour l\'avenir.',
                'categoryId' => 'avis',
              ],
              [
                'id' => 'f5',
                'text' => 'La loi entre en vigueur en mars.',
                'categoryId' => 'fait',
              ],
              [
                'id' => 'f6',
                'text' => 'Le ministre a mal géré le dossier.',
                'categoryId' => 'avis',
              ],
            ],
          ],
        ],
      ],
    ],
    [
      'slug' => 'subjonctif-et-nuances',
      'title' => 'Le subjonctif dans les médias',
      'subtitle' => 'Nuancer, douter, souhaiter : la grammaire de l\'opinion',
      'level' => 'C1',
      'theme' => 'grammaire',
      'audience' => 'enseignants',
      'mediaType' => 'video',
      'mediaUrl' => 'https://videos.pexels.com/video-files/32757192/13965008_3840_2160_25fps.mp4',
      'posterUrl' => 'https://images.pexels.com/photos/6936173/pexels-photo-6936173.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200',
      'durationLabel' => '5 min 12',
      'durationSeconds' => 312,
      'excerpt' => 'Analyse linguistique d\'extraits radiophoniques pour comprendre ce que le subjonctif fait au sens d\'un énoncé.',
      'description' => 'Ressource destinée aux enseignants et aux apprenants avancés : comment le mode subjonctif construit le doute, le souhait et le jugement. Le document propose des extraits authentiques et un commentaire métalinguistique.',
      'objectives' => [
        'Identifier les déclencheurs du subjonctif',
        'Distinguer indicatif et subjonctif dans le sens',
        'Employer le subjonctif à l\'écrit argumentatif',
      ],
      'transcript' => [
        [
          't' => 0,
          'speaker' => 'Linguiste',
          'text' => 'Le subjonctif n\'exprime pas l\'incertitude, il exprime la prise en charge.',
        ],
        [
          't' => 13,
          'speaker' => 'Linguiste',
          'text' => '« Je pense qu\'il viendra » : j\'assume. « Je ne pense pas qu\'il vienne » : je mets à distance.',
        ],
        [
          't' => 30,
          'speaker' => 'Animatrice',
          'text' => 'Donc le mode raconte la position du locuteur ?',
        ],
        [
          't' => 35,
          'speaker' => 'Linguiste',
          'text' => 'Exactement. Il est possible qu\'il pleuve : le locuteur reste en retrait.',
        ],
        [
          't' => 47,
          'speaker' => 'Animatrice',
          'text' => 'Et dans les titres de presse ?',
        ],
        [
          't' => 51,
          'speaker' => 'Linguiste',
          'text' => 'On l\'évite : il faut un effet de réel, donc de l\'indicatif.',
        ],
        [
          't' => 62,
          'speaker' => 'Linguiste',
          'text' => 'Retenez trois déclencheurs : la négation, le doute et la volonté.',
        ],
      ],
      'vocabulary' => [
        [
          'term' => 'la prise en charge',
          'definition' => 'Engagement du locuteur par rapport à son énoncé.',
          'example' => 'Le subjonctif marque une faible prise en charge.',
          'category' => 'expression',
        ],
        [
          'term' => 'mettre à distance',
          'definition' => 'Ne pas assumer pleinement une information.',
          'example' => 'Il met à distance ce qu\'il rapporte.',
          'category' => 'expression',
        ],
        [
          'term' => 'un déclencheur',
          'definition' => 'Élément qui provoque un choix grammatical.',
          'example' => '« Bien que » est un déclencheur du subjonctif.',
          'category' => 'nom',
        ],
        [
          'term' => 'métalinguistique',
          'definition' => 'Qui porte sur la langue elle-même.',
          'example' => 'Un commentaire métalinguistique.',
          'category' => 'adjectif',
        ],
        [
          'term' => 'l\'effet de réel',
          'definition' => 'Impression de vérité produite par un énoncé.',
          'example' => 'L\'indicatif produit un effet de réel.',
          'category' => 'expression',
        ],
      ],
      'teachingSheet' => [
        'durationLabel' => '2 h',
        'audienceLabel' => 'Formation d\'enseignants / classes C1-C2',
        'materials' => [
          'Vidéo',
          'Corpus d\'énoncés',
          'Grammaire de référence',
        ],
        'languagePoints' => [
          'Subjonctif après négation, doute, volonté',
          'Indicatif vs subjonctif : différence sémantique',
          'Subjonctif passé et concordance des temps',
        ],
        'steps' => [
          [
            'title' => 'Corpus à observer',
            'detail' => 'Distribuer 20 énoncés, les apprenants classent indicatif / subjonctif.',
            'minutes' => 30,
          ],
          [
            'title' => 'Mise en règle',
            'detail' => 'Faire émerger les déclencheurs avant de donner la règle.',
            'minutes' => 30,
          ],
          [
            'title' => 'Réécriture',
            'detail' => 'Transformer des énoncés pour changer la prise en charge.',
            'minutes' => 35,
          ],
          [
            'title' => 'Discussion pédagogique',
            'detail' => 'Comment enseigner cette nuance sans dogmatisme ?',
            'minutes' => 25,
          ],
        ],
        'evaluation' => 'Production d\'un court texte argumentatif contenant 5 subjonctifs justifiés.',
        'differentiation' => 'Accepter une justification métalinguistique orale plutôt qu\'écrite.',
      ],
      'featured' => false,
      'views' => 1980,
      'exercises' => [
        [
          'type' => 'texte-trous',
          'title' => 'Indicatif ou subjonctif ?',
          'instructions' => 'Conjuguez le verbe au mode qui convient, en vous appuyant sur le document.',
          'skill' => 'Grammaire avancée',
          'explanation' => 'Négation, doute et volonté déclenchent le subjonctif ; la certitude et la perception conservent l\'indicatif.',
          'payload' => [
            'text' => 'Je suis certain qu\'il ___ (avoir) raison. Je ne crois pas qu\'il ___ (être) disponible. Il faut que nous ___ (partir) tôt. Bien qu\'elle ___ (connaître) le sujet, elle hésite. Je souhaite que vous ___ (réussir).',
            'blanks' => [
              [
                'answers' => [
                  'a',
                ],
                'hint' => 'Certitude → indicatif',
                'explanation' => '« Je suis certain que » est suivi de l\'indicatif.',
              ],
              [
                'answers' => [
                  'soit',
                ],
                'hint' => 'Négation → subjonctif',
                'explanation' => '« Je ne crois pas que » déclenche le subjonctif.',
              ],
              [
                'answers' => [
                  'partions',
                ],
                'hint' => 'Subjonctif présent, 1re pers. pl.',
                'explanation' => '« Il faut que » impose le subjonctif.',
              ],
              [
                'answers' => [
                  'connaisse',
                  'connaisse',
                ],
                'hint' => 'Subjonctif, 3e pers. sing.',
                'explanation' => '« Bien que » est suivi du subjonctif.',
              ],
              [
                'answers' => [
                  'réussissiez',
                  'reussissiez',
                ],
                'hint' => 'Subjonctif, 2e pers. pl.',
                'explanation' => '« Je souhaite que » déclenche le subjonctif.',
              ],
            ],
            'wordBank' => [
              'a',
              'soit',
              'partions',
              'connaisse',
              'réussissiez',
            ],
          ],
        ],
        [
          'type' => 'qcm',
          'title' => 'Interpréter un choix de mode',
          'instructions' => 'Sélectionnez l\'interprétation correcte de chaque énoncé.',
          'skill' => 'Analyse linguistique',
          'explanation' => 'Le choix du mode traduit le degré d\'engagement du locuteur.',
          'payload' => [
            'questions' => [
              [
                'text' => '« Il est possible qu\'il vienne » signifie que le locuteur…',
                'options' => [
                  [
                    'text' => 'affirme l\'événement',
                    'correct' => false,
                    'feedback' => 'L\'indicatif serait attendu dans ce cas.',
                  ],
                  [
                    'text' => 'reste en retrait',
                    'correct' => true,
                    'feedback' => 'Oui : « possible que » marque une faible prise en charge.',
                  ],
                  [
                    'text' => 'ordonne l\'événement',
                    'correct' => false,
                    'feedback' => 'Ce serait l\'injonctif, pas le subjonctif ici.',
                  ],
                ],
              ],
              [
                'text' => 'Pourquoi le subjonctif est-il rare dans les titres de presse ?',
                'options' => [
                  [
                    'text' => 'Parce qu\'il est trop long',
                    'correct' => false,
                    'feedback' => 'Ce n\'est pas une question de longueur.',
                  ],
                  [
                    'text' => 'Parce qu\'il affaiblit l\'effet de réel',
                    'correct' => true,
                    'feedback' => 'Exact, c\'est ce qu\'explique le linguiste.',
                  ],
                  [
                    'text' => 'Parce qu\'il est interdit par la loi',
                    'correct' => false,
                    'feedback' => 'Bien sûr que non.',
                  ],
                ],
              ],
            ],
          ],
        ],
      ],
    ],
    [
      'slug' => 'les-courses-et-les-nombres',
      'title' => 'Faire les courses',
      'subtitle' => 'Quantités, prix et nombres au marché',
      'level' => 'A2',
      'theme' => 'vocabulaire',
      'audience' => 'apprenants',
      'mediaType' => 'video',
      'mediaUrl' => 'https://videos.pexels.com/video-files/28344955/12363393_1920_1080_30fps.mp4',
      'posterUrl' => 'https://images.pexels.com/photos/38785617/pexels-photo-38785617.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200',
      'durationLabel' => '2 min 35',
      'durationSeconds' => 155,
      'excerpt' => 'Au marché : combien ? combien ça coûte ? un kilo, une botte, une tranche. Le lexique des quantités en situation.',
      'description' => 'Séquence utile pour les apprenants de niveau A2 qui doivent gérer les achats du quotidien : demande de quantité, comparaison des prix, paiement. Le lexique est présenté en contexte, jamais sous forme de liste isolée.',
      'objectives' => [
        'Demander une quantité',
        'Comparer des prix',
        'Utiliser les partitifs (du, de la, des)',
      ],
      'transcript' => [
        [
          't' => 0,
          'speaker' => 'Cliente',
          'text' => 'Bonjour, vous avez des tomates ?',
        ],
        [
          't' => 6,
          'speaker' => 'Marchand',
          'text' => 'Bien sûr ! Vous en voulez combien ?',
        ],
        [
          't' => 11,
          'speaker' => 'Cliente',
          'text' => 'Un kilo, s\'il vous plaît.',
        ],
        [
          't' => 15,
          'speaker' => 'Marchand',
          'text' => 'Voilà. Deux euros quatre-vingt-dix le kilo.',
        ],
        [
          't' => 22,
          'speaker' => 'Cliente',
          'text' => 'Et il me faut du pain et un peu de fromage.',
        ],
        [
          't' => 29,
          'speaker' => 'Marchand',
          'text' => 'Une tranche ou deux ?',
        ],
        [
          't' => 33,
          'speaker' => 'Cliente',
          'text' => 'Deux tranches, merci. C\'est tout pour aujourd\'hui.',
        ],
        [
          't' => 40,
          'speaker' => 'Marchand',
          'text' => 'Ça fait six euros quarante.',
        ],
      ],
      'vocabulary' => [
        [
          'term' => 'une botte',
          'definition' => 'Ensemble de végétaux liés ensemble.',
          'example' => 'Une botte de radis.',
          'category' => 'nom',
        ],
        [
          'term' => 'une tranche',
          'definition' => 'Partie coupée d\'un aliment.',
          'example' => 'Deux tranches de jambon.',
          'category' => 'nom',
        ],
        [
          'term' => 'le partitif',
          'definition' => 'Article indéfini pour une quantité non comptée : du, de la, des.',
          'example' => 'Je prends du pain.',
          'category' => 'autre',
        ],
        [
          'term' => 'Ça fait…',
          'definition' => 'Formule pour annoncer le total.',
          'example' => 'Ça fait sept euros.',
          'category' => 'expression',
        ],
        [
          'term' => 'le kilo',
          'definition' => 'Unité de masse (1000 grammes).',
          'example' => 'Un kilo de pommes.',
          'category' => 'nom',
        ],
      ],
      'teachingSheet' => [
        'durationLabel' => '45 minutes',
        'audienceLabel' => 'A2, groupe de 15 apprenants',
        'materials' => [
          'Vidéo',
          'Fruits et légumes factices',
          'Billets factices',
        ],
        'languagePoints' => [
          'Les partitifs',
          'Les quantités et unités',
          'Les nombres jusqu\'à 100',
        ],
        'steps' => [
          [
            'title' => 'Marché dans la classe',
            'detail' => 'Installer un étal, distribuer les rôles.',
            'minutes' => 15,
          ],
          [
            'title' => 'Écoute et repérage',
            'detail' => 'Cocher les quantités entendues.',
            'minutes' => 10,
          ],
          [
            'title' => 'Calcul mental en français',
            'detail' => 'Dicter des prix, les apprenants totalisent.',
            'minutes' => 10,
          ],
          [
            'title' => 'Liste de courses',
            'detail' => 'Rédiger une liste avec partitifs.',
            'minutes' => 10,
          ],
        ],
        'evaluation' => 'Jeu de rôle évalué sur la précision des quantités et des prix.',
        'differentiation' => 'Autoriser la fiche lexique pour les profils débutants tardifs.',
      ],
      'featured' => false,
      'views' => 3967,
      'exercises' => [
        [
          'type' => 'glisser-deposer',
          'title' => 'Emballages et quantités',
          'instructions' => 'Rangez chaque mot dans la bonne famille. Clavier : cliquez l\'élément puis la colonne.',
          'skill' => 'Lexique',
          'explanation' => 'Le français distingue les unités de masse, de volume et de découpe.',
          'payload' => [
            'categories' => [
              [
                'id' => 'masse',
                'label' => 'Masse',
                'hint' => 'kilo, gramme',
              ],
              [
                'id' => 'volume',
                'label' => 'Volume',
                'hint' => 'litre, bouteille',
              ],
              [
                'id' => 'decoupe',
                'label' => 'Découpe',
                'hint' => 'tranche, botte',
              ],
            ],
            'items' => [
              [
                'id' => 'q1',
                'text' => 'un kilo de riz',
                'categoryId' => 'masse',
              ],
              [
                'id' => 'q2',
                'text' => 'une bouteille d\'eau',
                'categoryId' => 'volume',
              ],
              [
                'id' => 'q3',
                'text' => 'une tranche de pain',
                'categoryId' => 'decoupe',
              ],
              [
                'id' => 'q4',
                'text' => '200 grammes de fromage',
                'categoryId' => 'masse',
              ],
              [
                'id' => 'q5',
                'text' => 'un litre de lait',
                'categoryId' => 'volume',
              ],
              [
                'id' => 'q6',
                'text' => 'une botte de carottes',
                'categoryId' => 'decoupe',
              ],
            ],
          ],
        ],
        [
          'type' => 'texte-trous',
          'title' => 'Les partitifs',
          'instructions' => 'Complétez avec du, de la, de l\' ou des.',
          'skill' => 'Grammaire',
          'explanation' => 'Le partitif s\'accorde au genre du nom : du (masculin), de la (féminin), de l\' (voyelle), des (pluriel).',
          'payload' => [
            'text' => 'Je prends ___ pain, ___ salade, ___ huile et ___ œufs. Il me faut aussi ___ fromage.',
            'blanks' => [
              [
                'answers' => [
                  'du',
                ],
                'hint' => 'Masculin',
                'explanation' => '« du pain ».',
              ],
              [
                'answers' => [
                  'de la',
                ],
                'hint' => 'Féminin',
                'explanation' => '« de la salade ».',
              ],
              [
                'answers' => [
                  'de l\'',
                  'de l',
                ],
                'hint' => 'Devant voyelle',
                'explanation' => '« de l\'huile ».',
              ],
              [
                'answers' => [
                  'des',
                ],
                'hint' => 'Pluriel',
                'explanation' => '« des œufs ».',
              ],
              [
                'answers' => [
                  'du',
                ],
                'hint' => 'Masculin',
                'explanation' => '« du fromage ».',
              ],
            ],
            'wordBank' => [
              'du',
              'de la',
              'de l\'',
              'des',
              'du',
            ],
          ],
        ],
      ],
    ],
    [
      'slug' => 'fetes-et-traditions',
      'title' => 'Fêtes et traditions francophones',
      'subtitle' => 'Célébrer ensemble : de la musique aux repas partagés',
      'level' => 'B1',
      'theme' => 'culture',
      'audience' => 'apprenants',
      'mediaType' => 'video',
      'mediaUrl' => 'https://videos.pexels.com/video-files/32757190/13965026_3840_2160_24fps.mp4',
      'posterUrl' => 'https://images.pexels.com/photos/18189714/pexels-photo-18189714.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200',
      'durationLabel' => '3 min 00',
      'durationSeconds' => 180,
      'excerpt' => 'Quatre villes, quatre fêtes : on explore les rituels, les tables et les musiques qui rassemblent les francophones.',
      'description' => 'Ressource culturelle de niveau B1 : le document décrit plusieurs fêtes francophones et les pratiques qui les accompagnent. Les exercices portent sur la description d\'un rituel, l\'emploi de l\'imparfait et le lexique de la célébration.',
      'objectives' => [
        'Décrire une fête et son déroulement',
        'Employer l\'imparfait pour la description',
        'Comparer des pratiques culturelles',
      ],
      'transcript' => [
        [
          't' => 0,
          'speaker' => 'Narrateur',
          'text' => 'Partout dans la francophonie, les fêtes rythment l\'année.',
        ],
        [
          't' => 10,
          'speaker' => 'Fatou',
          'text' => 'Chez nous, on prépare le repas la veille, toute la famille participe.',
        ],
        [
          't' => 21,
          'speaker' => 'Marc',
          'text' => 'À Bruxelles, on décore la ville et l\'on danse jusqu\'au matin.',
        ],
        [
          't' => 32,
          'speaker' => 'Narrateur',
          'text' => 'Les enfants, eux, préparent des décorations depuis des semaines.',
        ],
        [
          't' => 42,
          'speaker' => 'Anaïs',
          'text' => 'Il y avait une tradition que j\'adorais : les chansons improvisées.',
        ],
        [
          't' => 54,
          'speaker' => 'Narrateur',
          'text' => 'Quelle que soit la ville, l\'important reste le partage.',
        ],
      ],
      'vocabulary' => [
        [
          'term' => 'la veille',
          'definition' => 'Le jour qui précède.',
          'example' => 'On prépare le repas la veille.',
          'category' => 'nom',
        ],
        [
          'term' => 'un rituel',
          'definition' => 'Ensemble de gestes répétés lors d\'une cérémonie.',
          'example' => 'Le rituel du thé.',
          'category' => 'nom',
        ],
        [
          'term' => 'l\'imparfait',
          'definition' => 'Temps de la description et de l\'habitude dans le passé.',
          'example' => 'Quand j\'étais petit, on chantait.',
          'category' => 'autre',
        ],
        [
          'term' => 'partager',
          'definition' => 'Mettre en commun.',
          'example' => 'Partager un repas.',
          'category' => 'verbe',
        ],
        [
          'term' => 'quel que soit',
          'definition' => 'Expression de la concession.',
          'example' => 'Quelle que soit la ville, on festoie.',
          'category' => 'expression',
        ],
      ],
      'teachingSheet' => [
        'durationLabel' => '1 h',
        'audienceLabel' => 'B1, classe multiculturelle',
        'materials' => [
          'Vidéo',
          'Photos de fêtes',
          'Feuilles A3',
        ],
        'languagePoints' => [
          'L\'imparfait de description',
          'Les connecteurs temporels',
          'Le lexique de la fête',
        ],
        'steps' => [
          [
            'title' => 'Photo-langue',
            'detail' => 'Chaque apprenant décrit une fête qu\'il connaît, 1 minute.',
            'minutes' => 15,
          ],
          [
            'title' => 'Vidéo',
            'detail' => 'Repérer les moments de la journée et les verbes à l\'imparfait.',
            'minutes' => 20,
          ],
          [
            'title' => 'Affiche collective',
            'detail' => 'Créer l\'affiche d\'une fête imaginaire, en groupes.',
            'minutes' => 20,
          ],
          [
            'title' => 'Restitution',
            'detail' => 'Présenter l\'affiche à l\'oral en 90 secondes.',
            'minutes' => 5,
          ],
        ],
        'evaluation' => 'Restitution orale : richesse du lexique et maîtrise de l\'imparfait.',
        'differentiation' => 'Fournir une banque de verbes à l\'imparfait pour soutenir la production.',
      ],
      'featured' => false,
      'views' => 5244,
      'exercises' => [
        [
          'type' => 'qcm',
          'title' => 'Comprendre les pratiques',
          'instructions' => 'Répondez aux questions après le visionnage.',
          'skill' => 'Compréhension orale',
          'explanation' => 'On repère les informations explicites avant de travailler l\'interprétation.',
          'payload' => [
            'questions' => [
              [
                'text' => 'Quand Fatou et sa famille préparent-elles le repas ?',
                'options' => [
                  [
                    'text' => 'Le jour même',
                    'correct' => false,
                    'feedback' => 'Non, elle parle de la veille.',
                  ],
                  [
                    'text' => 'La veille',
                    'correct' => true,
                    'feedback' => 'Exact.',
                  ],
                  [
                    'text' => 'Une semaine avant',
                    'correct' => false,
                    'feedback' => 'Ce n\'est pas mentionné.',
                  ],
                ],
              ],
              [
                'text' => 'Quelle tradition Anaïs adorait-elle ?',
                'options' => [
                  [
                    'text' => 'Les décorations',
                    'correct' => false,
                    'feedback' => 'C\'est le fait des enfants.',
                  ],
                  [
                    'text' => 'Les chansons improvisées',
                    'correct' => true,
                    'feedback' => 'Oui.',
                  ],
                  [
                    'text' => 'Le repas',
                    'correct' => false,
                    'feedback' => 'Elle ne le mentionne pas.',
                  ],
                ],
              ],
            ],
          ],
        ],
        [
          'type' => 'reordonner',
          'title' => 'Raconter dans l\'ordre chronologique',
          'instructions' => 'Remettez les étapes de la fête dans l\'ordre où elles se produisent.',
          'skill' => 'Cohérence narrative',
          'explanation' => 'Les connecteurs d\'abord, ensuite, enfin structurent le récit.',
          'payload' => [
            'items' => [
              [
                'id' => 't1',
                'text' => 'D\'abord, on prépare le repas la veille.',
              ],
              [
                'id' => 't2',
                'text' => 'Ensuite, on décore la ville.',
              ],
              [
                'id' => 't3',
                'text' => 'Puis les enfants distribuent les décorations.',
              ],
              [
                'id' => 't4',
                'text' => 'Après, tout le monde danse.',
              ],
              [
                'id' => 't5',
                'text' => 'Enfin, on partage le dessert.',
              ],
            ],
            'explanation' => 'Repérez les connecteurs : d\'abord, ensuite, puis, après, enfin.',
          ],
        ],
        [
          'type' => 'glisser-deposer',
          'title' => 'Imparfait ou passé composé ?',
          'instructions' => 'Classez chaque énoncé selon le temps verbal utilisé.',
          'skill' => 'Grammaire',
          'explanation' => 'L\'imparfait décrit un arrière-plan ; le passé composé relate un événement ponctuel.',
          'payload' => [
            'categories' => [
              [
                'id' => 'imparfait',
                'label' => 'Imparfait',
                'hint' => 'Description, habitude',
              ],
              [
                'id' => 'passe',
                'label' => 'Passé composé',
                'hint' => 'Action ponctuelle',
              ],
            ],
            'items' => [
              [
                'id' => 'p1',
                'text' => 'Quand j\'étais petit, on chantait.',
                'categoryId' => 'imparfait',
              ],
              [
                'id' => 'p2',
                'text' => 'Hier, nous avons dansé jusqu\'à minuit.',
                'categoryId' => 'passe',
              ],
              [
                'id' => 'p3',
                'text' => 'La rue était décorée de fleurs.',
                'categoryId' => 'imparfait',
              ],
              [
                'id' => 'p4',
                'text' => 'Elle a préparé un plat traditionnel.',
                'categoryId' => 'passe',
              ],
              [
                'id' => 'p5',
                'text' => 'Les enfants jouaient dans la cour.',
                'categoryId' => 'imparfait',
              ],
            ],
          ],
        ],
      ],
    ],
  ],
  'teaching' => [
    [
      'slug' => 'fiche-cafe-a2',
      'title' => 'Scénario de classe : la commande au café (A2)',
      'level' => 'A2',
      'theme' => 'culture',
      'format' => 'PDF',
      'durationLabel' => '45 min',
      'description' => 'Déroulé complet d\'une séance de 45 minutes autour de la commande au café, avec jeux de rôle et grille d\'évaluation.',
      'objectives' => [
        'Réutiliser les formules de politesse en interaction',
        'Calculer et énoncer un prix',
        'Prendre part à un échange service / client',
      ],
      'steps' => [
        [
          'title' => 'Mise en situation',
          'detail' => 'Vidéo muette : deviner la scène.',
          'minutes' => 5,
        ],
        [
          'title' => 'Compréhension',
          'detail' => 'QCM de la page ressource.',
          'minutes' => 10,
        ],
        [
          'title' => 'Systématisation',
          'detail' => 'Texte à trous sur les formules figées.',
          'minutes' => 10,
        ],
        [
          'title' => 'Jeu de rôle',
          'detail' => 'Rotation serveur / client toutes les 3 minutes.',
          'minutes' => 15,
        ],
        [
          'title' => 'Bilan',
          'detail' => 'Auto-évaluation avec la grille.',
          'minutes' => 5,
        ],
      ],
      'downloads' => 1245,
    ],
    [
      'slug' => 'fiche-francophonie-b1',
      'title' => 'Micro-trottoir : quelle langue pour la rue ? (B1)',
      'level' => 'B1',
      'theme' => 'francophonie',
      'format' => 'Word',
      'durationLabel' => '1 h 30',
      'description' => 'Scénario de production orale : concevoir un questionnaire, interroger ses pairs et restituer les résultats.',
      'objectives' => [
        'Formuler des questions d\'enquête',
        'Recueillir et classer des réponses',
        'Présenter des résultats à l\'oral',
      ],
      'steps' => [
        [
          'title' => 'Carte mentale',
          'detail' => 'Les langues de la classe.',
          'minutes' => 15,
        ],
        [
          'title' => 'Reportage modèle',
          'detail' => 'Écoute du reportage sur Dakar.',
          'minutes' => 25,
        ],
        [
          'title' => 'Enquête',
          'detail' => 'Interview en binôme avec dictaphone.',
          'minutes' => 30,
        ],
        [
          'title' => 'Restitution',
          'detail' => 'Synthèse orale de 2 minutes.',
          'minutes' => 20,
        ],
      ],
      'downloads' => 870,
    ],
    [
      'slug' => 'fiche-connecteurs-b2',
      'title' => 'Atelier connecteurs et argumentation (B2)',
      'level' => 'B2',
      'theme' => 'grammaire',
      'format' => 'PDF',
      'durationLabel' => '1 h 15',
      'description' => 'Fiche méthodologique pour faire produire un paragraphe argumenté en variant les connecteurs logiques.',
      'objectives' => [
        'Identifier les familles de connecteurs',
        'Réécrire un paragraphe en variant la cohésion',
        'Auto-corriger sa production',
      ],
      'steps' => [
        [
          'title' => 'Tri de connecteurs',
          'detail' => 'Classement en quatre familles.',
          'minutes' => 20,
        ],
        [
          'title' => 'Analyse d\'un texte',
          'detail' => 'Surligner les connecteurs d\'un article.',
          'minutes' => 20,
        ],
        [
          'title' => 'Réécriture',
          'detail' => 'Produire deux versions d\'un même paragraphe.',
          'minutes' => 25,
        ],
        [
          'title' => 'Pair feedback',
          'detail' => 'Relecture croisée avec grille.',
          'minutes' => 10,
        ],
      ],
      'downloads' => 1592,
    ],
    [
      'slug' => 'fiche-litterature-c1',
      'title' => 'Atelier d\'écriture créative : écrire en C1/C2',
      'level' => 'C1',
      'theme' => 'litterature',
      'format' => 'Word',
      'durationLabel' => '2 h',
      'description' => 'Démarche d\'écriture inspirée des textes francophones contemporains : contraintes, réécritures et publication.',
      'objectives' => [
        'Exploiter une contrainte d\'écriture',
        'Varier les registres et les voix narratives',
        'Éditer et publier un texte court',
      ],
      'steps' => [
        [
          'title' => 'Lecture à voix haute',
          'detail' => 'Extrait d\'auteur francophone.',
          'minutes' => 20,
        ],
        [
          'title' => 'Contrainte',
          'detail' => 'Choisir une contrainte (lipogramme, tempo, pronom unique).',
          'minutes' => 15,
        ],
        [
          'title' => 'Écriture',
          'detail' => 'Temps d\'écriture personnelle silencieuse.',
          'minutes' => 45,
        ],
        [
          'title' => 'Atelier',
          'detail' => 'Lecture croisée et suggestions.',
          'minutes' => 30,
        ],
        [
          'title' => 'Publication',
          'detail' => 'Mise en page du recueil de classe.',
          'minutes' => 10,
        ],
      ],
      'downloads' => 604,
    ],
    [
      'slug' => 'fiche-evaluation-a1',
      'title' => 'Évaluer en A1 : grilles simples et critères lisibles',
      'level' => 'A1',
      'theme' => 'vocabulaire',
      'format' => 'PDF',
      'durationLabel' => '30 min',
      'description' => 'Fiche pratique : trois grilles d\'évaluation critériées prêtes à imprimer pour les niveaux A1 et A2.',
      'objectives' => [
        'Choisir des critères observables',
        'Rendre l\'évaluation lisible pour l\'apprenant',
        'Mettre en place l\'auto-évaluation',
      ],
      'steps' => [
        [
          'title' => 'Choix des critères',
          'detail' => 'Trois critères maximum par tâche.',
          'minutes' => 10,
        ],
        [
          'title' => 'Grille',
          'detail' => 'Remplir la grille pendant l\'activité.',
          'minutes' => 10,
        ],
        [
          'title' => 'Restitution',
          'detail' => 'Feedback individuel de 2 minutes.',
          'minutes' => 10,
        ],
      ],
      'downloads' => 2110,
    ],
  ],
];
