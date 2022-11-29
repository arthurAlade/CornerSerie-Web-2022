<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Film;
use App\Entity\Personne;
use App\Entity\Saison;
use App\Entity\Serie;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use http\Client\Curl\User;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        //===========================CATEGORIE===============================
        $drame = new Categorie(); $drame->setCategorie('Drame');
        $action = new Categorie(); $action->setCategorie('Action');
        $thriller = new Categorie(); $thriller->setCategorie('Thriller');
        $aventure = new Categorie(); $aventure->setCategorie('Aventure');
        $animation = new Categorie(); $animation->setCategorie('Animation');
        $documentaire = new Categorie(); $documentaire->setCategorie('Documentaire');
        $spectacle = new Categorie(); $spectacle->setCategorie('Spectacle');
        $comedie = new Categorie(); $comedie->setCategorie('Comedie');
        $fantastique = new Categorie(); $fantastique->setCategorie('Fantastique');
        $horreur = new Categorie(); $horreur->setCategorie('Horreur');
        $humour = new Categorie(); $humour->setCategorie('Humour');
        $policier = new Categorie(); $policier->setCategorie('Policier');
        $scienceFiction = new Categorie(); $scienceFiction->setCategorie('Science-Fiction');
        $romance = new Categorie(); $romance->setCategorie('Romance');
        //=============================FILM==================================
        //--------------------Il était une fois le bronx---------------------
        $ilEtaitUneFoisLeBronx = new Film();
        $ilEtaitUneFoisLeBronx->setTitre('Il était une fois le Bronx');
        $ilEtaitUneFoisLeBronx->setAnneeSortie(1993);
        $ilEtaitUneFoisLeBronx->setSynopsis("L'histoire de la communauté italienne des années 60 dans le Bronx à travers les yeux de Calogero, neuf ans, qui hésite entre la vie de son père, honnête travailleur, et celle des affranchis, qui semble plus prometteuse.");
        $ilEtaitUneFoisLeBronx->setAffiche('images/films/il_etait_une_fois_le_bronx.jpg');
        $ilEtaitUneFoisLeBronx->addCategory($drame);
        $ilEtaitUneFoisLeBronx->addCategory($comedie);

        $deNiro = new Personne();
        $deNiro->setPrenom('Robert');
        $deNiro->setNom('De Niro');

        $narducci = new Personne();
        $narducci->setNom('Narducci');
        $narducci->setPrenom('Kathrine');

        $palminteri = new Personne();
        $palminteri->setNom('Palminteri');
        $palminteri->setPrenom('Chazz');

        $deNiro->addFilmsRealise($ilEtaitUneFoisLeBronx);
        $narducci->addFilmsJoue($ilEtaitUneFoisLeBronx);
        $palminteri->addFilmsProduit($ilEtaitUneFoisLeBronx);

        $manager->persist($ilEtaitUneFoisLeBronx);
        //--------------------------------------------------
        //----------------La Cité de la Peur----------------
        $laCiteDeLaPeur = new Film();
        $laCiteDeLaPeur->setTitre('La cité de la peur');
        $laCiteDeLaPeur->setAnneeSortie(1994);
        $laCiteDeLaPeur->setAffiche('images/films/la_cite_de_la_peur.png');
        $laCiteDeLaPeur->setSynopsis("De nos jours, à Cannes, pendant le Festival. Pas facile pour Odile Deray, petite attachée de presse de cinéma, de faire parler de son film 'Red is Dead'. Il faut avouer qu'il s'agit d'un film d'horreur de série Z, un petit budget aux acteurs improbables. Pourtant un jour, la chance sourit à Odile : un tueur commet des meurtres exactement de la même manière que dans 'Red is Dead', l'occasion est trop belle : de vrais meurtres, comme dans son film, en plein Festival de Cannes ! Comme publicité, on ne peut pas rêver mieux... Odile fait donc immédiatement venir Simon Jeremi, l'acteur principal de 'Red is Dead', un enfant de trente ans un peu simplet. Pour le protéger - et surtout pour la frime - elle engage aussi un garde du corps, Serge Karamazov, plus intéressé par les filles que par sa mission. Dans la fièvre de Cannes, avec un tueur en liberté, un politicien véreux et un commissaire principal obsédé par les médias, Odile, Simon et Kara devront jouer des coudes pour arriver intacts jusqu'aux marches du Grand Palais. Mais même là, ils ne seront pas au bout de leurs péripéties... ");
        $laCiteDeLaPeur->addCategory($comedie);
        $laCiteDeLaPeur->addCategory($policier);

        //------ Acteurs
        $chabat = new Personne();
        $chabat->setNom('Chabat'); $chabat->setPrenom('Alain'); $chabat->setPhoto('images/personnes/alain_chabat.png');
        $chabat->addFilmsJoue($laCiteDeLaPeur);

        $lauby = new Personne();
        $lauby->setNom('Lauby'); $lauby->setPrenom('Chantal'); $lauby->setPhoto('images/personnes/chantal_lauby.png');
        $lauby->addFilmsJoue($laCiteDeLaPeur);

        $darmon = new Personne();
        $darmon->setNom('Darmon'); $darmon->setPrenom('Gérard'); $darmon->setPhoto('images/personnes/gerard_darmon.png');
        $darmon->addFilmsJoue($laCiteDeLaPeur);

        $farrugia = new Personne();
        $farrugia->setNom('Farrugia'); $farrugia->setPrenom('Dominique');
        $farrugia->addFilmsJoue($laCiteDeLaPeur);

        $karmann = new Personne();
        $karmann->setNom('Karmann'); $karmann->setPrenom('Sam');
        $karmann->addFilmsJoue($laCiteDeLaPeur);

        //------ Réalisateurs
        $berberian = new Personne();
        $berberian->setNom('Berbérian'); $berberian->setPrenom('Alain');
        $berberian->addFilmsRealise($laCiteDeLaPeur);

        $manager->persist($laCiteDeLaPeur);

        //--------------------------------------------------
        //---------L'étrange Noël de monsieur Jack----------
        $lEtrangeNoelDeMonsieurJack = new Film();
        $lEtrangeNoelDeMonsieurJack->setTitre("L'étrange Noël de monsieur Jack");
        $lEtrangeNoelDeMonsieurJack->setAnneeSortie(1993);
        $lEtrangeNoelDeMonsieurJack->setAffiche('images/films/l_etrange_noel_de_monsieur_jack.png');
        $lEtrangeNoelDeMonsieurJack->setSynopsis("Jack Skellington, roi des citrouilles et guide de Halloween-ville, s''ennuie : depuis des siècles, il en a assez de préparer la même fête de Halloween qui revient chaque année, et il rêve de changement. C''est alors qu''il a l''idée de s''emparer de la fête de Noël... ");
        $lEtrangeNoelDeMonsieurJack->addCategory($animation);
        $lEtrangeNoelDeMonsieurJack->addCategory($fantastique);

        //------ Réalisateurs
        $burton = new Personne();
        $burton->setPrenom('Tim'); $burton->setNom('Burton'); $burton->setPhoto('images/personnes/tim_burton.png');
        $burton->addFilmsRealise($lEtrangeNoelDeMonsieurJack);

        $selick = new Personne();
        $selick->setNom('Selick'); $selick->setPrenom('Henry');
        $selick->addFilmsRealise($lEtrangeNoelDeMonsieurJack);

        $manager->persist($lEtrangeNoelDeMonsieurJack);

        //--------------------------------------------------
        //---------------Les Noces funèbres-----------------
        $lesNocesFunebres = new Film();
        $lesNocesFunebres->setTitre('Les noces funèbres');
        $lesNocesFunebres->setAnneeSortie(2005);
        $lesNocesFunebres->setAffiche('images/films/les_noces_funebres.png');
        $lesNocesFunebres->setSynopsis("Au XIXe siècle, dans un petit village d''Europe de l'est, Victor, un jeune homme, découvre le monde de l''au-delà après avoir épousé, sans le vouloir, le cadavre d''une mystérieuse mariée. Pendant son voyage, sa promise, Victoria l''attend désespérément dans le monde des vivants. Bien que la vie au Royaume des Morts s''avère beaucoup plus colorée et joyeuse que sa véritable existence, Victor apprend que rien au monde, pas même la mort, ne pourra briser son amour pour sa femme. ");
        $lesNocesFunebres->addCategory($fantastique);
        $lesNocesFunebres->addCategory($animation);

        //------ Réalisateurs
        $burton->addFilmsRealise($lesNocesFunebres);

        $manager->persist($lesNocesFunebres);

        //--------------------------------------------------
        //----------Alice au pays des merveilles------------
        $aliceAuPaysDesMerveilles = new Film();
        $aliceAuPaysDesMerveilles->setTitre('Alice au pays des merveilles');
        $aliceAuPaysDesMerveilles->setAnneeSortie(2010);
        $aliceAuPaysDesMerveilles->setAffiche('images/films/alice_au_pays_des_merveilles.png');
        $aliceAuPaysDesMerveilles->setSynopsis("Alice, désormais âgée de 19 ans, retourne dans le monde fantastique qu''elle a découvert quand elle était enfant. Elle y retrouve ses amis le Lapin Blanc, Bonnet Blanc et Blanc Bonnet, le Loir, la Chenille, le Chat du Cheshire et, bien entendu, le Chapelier Fou. Alice s''embarque alors dans une aventure extraordinaire où elle accomplira son destin : mettre fin au règne de terreur de la Reine Rouge.");
        $aliceAuPaysDesMerveilles->addCategory($fantastique);
        $aliceAuPaysDesMerveilles->addCategory($animation);

        //------ Acteurs
        $wasikowska = new Personne();
        $wasikowska->setNom('Wasikowska'); $wasikowska->setPrenom('Mia');
        $wasikowska->addFilmsJoue($aliceAuPaysDesMerveilles);

        $depp = new Personne();
        $depp->setNom('Depp'); $depp->setPrenom('Johnny');
        $depp->addFilmsJoue($aliceAuPaysDesMerveilles);

        $hathaway = new Personne();
        $hathaway->setNom('Hathaway'); $hathaway->setPrenom('Anne');
        $hathaway->addFilmsJoue($aliceAuPaysDesMerveilles);

        $bonham = new Personne();
        $bonham->setNom('Bonham'); $bonham->setPrenom('Carter');
        $bonham->addFilmsJoue($aliceAuPaysDesMerveilles);

        //------ Réalisateurs
        $burton->addFilmsRealise($aliceAuPaysDesMerveilles);

        $manager->persist($aliceAuPaysDesMerveilles);

        //--------------------------------------------------
        //---------Alice de l'autre coté du miroir----------
        $aliceDeLAutreCoteDuMiroir = new Film();
        $aliceDeLAutreCoteDuMiroir->setTitre("Alice de l'autre côté du miroir");
        $aliceDeLAutreCoteDuMiroir->setAnneeSortie(2016);
        $aliceDeLAutreCoteDuMiroir->setAffiche('images/films/alice_de_l_autre_cote_du_miroir.png');
        $aliceDeLAutreCoteDuMiroir->setSynopsis("Les nouvelles aventures d''Alice et du Chapelier Fou. Alice replonge au pays des merveilles pour aider ses amis à combattre le Maître du Temps. ");
        $aliceDeLAutreCoteDuMiroir->addCategory($animation);
        $aliceDeLAutreCoteDuMiroir->addCategory($fantastique);

        //------ Acteurs
        $baronCohen = new Personne();
        $baronCohen->setNom('Baron Cohen'); $baronCohen->setPrenom('Sacha');
        $baronCohen->addFilmsJoue($aliceDeLAutreCoteDuMiroir);

        $wasikowska->addFilmsJoue($aliceDeLAutreCoteDuMiroir);
        $depp->addFilmsJoue($aliceDeLAutreCoteDuMiroir);
        $hathaway->addFilmsJoue($aliceDeLAutreCoteDuMiroir);
        $bonham->addFilmsJoue($aliceDeLAutreCoteDuMiroir);

        //------ Réalisateurs
        $bobin = new Personne();
        $bobin->setNom('Bobin'); $bobin->setPrenom('James');
        $bobin->addFilmsRealise($aliceDeLAutreCoteDuMiroir);

        $manager->persist($aliceDeLAutreCoteDuMiroir);

        //===========================SERIES================================
        //----------------------Desperate Housewives-----------------------
        $desperateHousewives = new Serie();
        $desperateHousewives->setTitre('Desperate Housewives');
        $desperateHousewives->addCategory($comedie);
        $desperateHousewives->addCategory($drame);
        //------ Acteurs
        $longoria = new Personne();
        $longoria->setPrenom('Eva');
        $longoria->setNom('Longoria');
        $longoria->setPhoto('images/personnes/eva_longoria.png');
        $longoria->addSeriesJouee($desperateHousewives);

        $cross = new Personne();
        $cross->setNom('Cross');
        $cross->setPrenom('Marcia');
        $cross->setPhoto('images/personnes/marcia_cross.png');
        $cross->addSeriesJouee($desperateHousewives);

        $hatcher = new Personne();
        $hatcher->setNom('Hatcher');
        $hatcher->setPrenom('Teri');
        $hatcher->setPhoto('images/personnes/teri_hatcher.png');
        $hatcher->addSeriesJouee($desperateHousewives);

        $huffman = new Personne();
        $huffman->setNom('Huffman'); $huffman->setPrenom('Felicity'); $huffman->setPhoto('images/personnes/felicity_huffman.png');
        $huffman->addSeriesJouee($desperateHousewives);

        $sheridan = new Personne();
        $sheridan->setNom('Sheridan'); $sheridan->setPrenom('Nicolette'); $sheridan->setPhoto('images/personnes/nicolette_sheridan.png');
        $sheridan->addSeriesJouee($desperateHousewives);

        $denton = new Personne();
        $denton->setNom('Denton'); $denton->setPrenom('James'); $denton->setPhoto('images/personnes/james_denton.png');
        $denton->addSeriesJouee($desperateHousewives);

        //------ Realisateur
        $cherry = new Personne();
        $cherry->setNom('Cherry');
        $cherry->setPrenom('Marc');

        $cherry->addSeriesRealisee($desperateHousewives);

        //------ Saisons
        $despSaison1 = new Saison();
        $despSaison1->setNbEpisodes(23);
        $despSaison1->setNumero(1);
        $despSaison1->setAffiche('images/series/desperate_saison1.png');
        $despSaison1->setSynopsis("Alors qu’elle mène une vie de famille exemplaire dans sa paisible demeure de la banlieue chic de Wisteria Lane, Mary Alice Young décide de mettre fin à ses jours. D’outre-tombe, elle commente le quotidien de son entourage et notamment celui de ses quatre amies les plus proches : Susan Mayer, une mère divorcée en quête du grand amour ; Gabrielle Solis, une ex-mannequin volage qui trompe son mari Carlos avec le jardinier ; Bree Van De Kamp qui essaye désespérément de sauver son mariage ; et Lynette Scavo, une femme au foyer qui a abandonné à contrecœur sa brillante carrière pour élever ses enfants. Ensemble, elles vont chercher à comprendre le suicide de leur amie, mais des secrets bien gardés pourraient refaire surface et venir bouleverser leurs vies.");
        $despSaison1->setSerie($desperateHousewives);

        $despSaison2 = new Saison();
        $despSaison2->setNumero(2); $despSaison2->setNbEpisodes(24);
        $despSaison2->setAffiche('images/series/desperate_saison2.png');
        $despSaison2->setSynopsis("Après avoir enterré Rex, les relations de Bree avec son fils Andrew sont de plus en plus tendues. De retour au travail, Lynette fait face à un patron névrotique, tandis que Tom assume son nouveau rôle d’homme au foyer. De son côté, Susan s’éloigne de Mike et Gabrielle est prête à tout pour devenir mère. L’arrivée de la mystérieuse Betty Applewhite et de ses deux fils, Matthew et Caleb, pourrait quant à elle, bouleverser la quiétude de Wisteria Lane.");
        $despSaison2->setSerie($desperateHousewives);

        $despSaison3 = new Saison();
        $despSaison3->setNumero(3); $despSaison3->setNbEpisodes(23);
        $despSaison3->setAffiche('images/series/desperate_saison3.png');
        $despSaison3->setSynopsis("Renversé par une voiture il y a six mois maintenant, Mike est toujours dans le coma. Susan, qui reste chaque jour à son chevet, doute de ses sentiments pour lui après avoir rencontré Ian. Dans le même temps, Bree file le parfait amour avec Orson Hodge, alors que le divorce de Gabrielle et Carlos tourne à la guerre ouverte. Lynette, quant à elle, aide Tom à poursuivre son rêve professionnel et Edie met tout en œuvre pour séduire un homme du quartier.");
        $despSaison3->setSerie($desperateHousewives);

        $despSaison4 = new Saison();
        $despSaison4->setNumero(4); $despSaison4->setNbEpisodes(17);
        $despSaison4->setAffiche('images/series/desperate_saison4.png');
        $despSaison4->setSynopsis("Un mois après le mariage de Gabrielle et du Maire de Fairview, Susan, désormais enceinte, s’inquiète de la dépendance de son mari aux analgésiques. Pendant ce temps, Bree simule une grossesse pour protéger la réputation de sa fille et Lynette doit lutter contre son cancer. Le retour de Katherine Mayfair et de sa famille à Wisteria Lane pourrait bien créer un nouveau drame dans le quartier.");
        $despSaison4->setSerie($desperateHousewives);

        $despSaison5 = new Saison();
        $despSaison5->setNumero(5); $despSaison5->setNbEpisodes(24);
        $despSaison5->setAffiche('images/series/desperate_saison5.png');
        $despSaison5->setSynopsis("Cinq années sont passées dans le quartier de Wisteria Lane et la vie semble paisible. Bree dirige désormais une entreprise de restauration avec Katherine et Gabrielle doit s’occuper de ses deux filles. De son côté, Lynette tente de gérer au mieux ses deux turbulents adolescents, tandis que Susan élève seule son fils MJ depuis son divorce avec Mike. En parallèle, Edie fait son retour à Wysteria Lane accompagnée de son nouveau mari, Dave Williams, dont le terrible secret risque de compliquer la vie de Susan et Mike.");
        $despSaison5->setSerie($desperateHousewives);

        $despSaison6 = new Saison();
        $despSaison6->setNumero(6); $despSaison6->setNbEpisodes(23);
        $despSaison6->setAffiche('images/series/desperate_saison6.png');
        $despSaison6->setSynopsis("La famille Bolen arrive à Wisteria Lane pour tenter d’échapper à son mystérieux passé. Pendant ce temps, Mike se marie pour la seconde fois alors que Bree entretient une relation extra-conjugale avec son avocat. Excédée par le comportement de sa nièce Ana, Gabrielle s’impose comme sa tutrice légale. De son côté, Lynette fait face à une grossesse non désirée et Katherine souffre d’une sévère dépression.");
        $despSaison6->setSerie($desperateHousewives);

        $despSaison7 = new Saison();
        $despSaison7->setNumero(7); $despSaison7->setNbEpisodes(23);
        $despSaison7->setAffiche('images/series/desperate_saison7.png');
        $despSaison7->setSynopsis("Après avoir perdu son mari et son entreprise, Bree tente de reconstruire sa vie. Contrainte de cacher un lourd secret sur la mort de sa belle-mère, Gabrielle voit sa vie se compliquer et ce d’autant plus qu’elle découvre que sa fille Juanita a été échangée à la naissance. En parallèle, des problèmes financiers obligent Susan à déménager, tandis que Lynette et Tom font face à des difficultés conjugales. Paul Young, quant à lui, est de retour dans le quartier bien décidé à se venger des habitants.");
        $despSaison7->setSerie($desperateHousewives);

        $despSaison8 = new Saison();
        $despSaison8->setNumero(8); $despSaison8->setNbEpisodes(23);
        $despSaison8->setAffiche('images/series/desperate_saison8.png');
        $despSaison8->setSynopsis("Le meurtre du beau-père de Gabrielle a des conséquences considérables sur les femmes de Wisteria Lane. Rongée par la culpabilité, Susan s’éloigne de ses amies alors que Gabrielle aide Carlos à surmonter cette épreuve. Pendant ce temps, Tom et Lynette s’efforcent de cacher leur rupture à leurs enfants et de sauver les apparences. De son côté, Bree fait de son mieux pour dissimuler le meurtre d’Alejandro mais devient rapidement la cible d’une enquête policière.");
        $despSaison8->setSerie($desperateHousewives);

        $manager->persist($desperateHousewives);
        $manager->persist($despSaison1);
        $manager->persist($despSaison2);
        $manager->persist($despSaison3);
        $manager->persist($despSaison4);
        $manager->persist($despSaison5);
        $manager->persist($despSaison6);
        $manager->persist($despSaison7);
        $manager->persist($despSaison8);

        //-----------------------------------------------------------------
        //------------------------Soupçon de Magie-------------------------
        $soupconDeMagie = new Serie();
        $soupconDeMagie->setTitre('Soupçon de magie');
        $soupconDeMagie->addCategory($drame);
        $soupconDeMagie->addCategory($comedie);

        //------ Acteurs
        $bell = new Personne();
        $bell->setNom('Bell');
        $bell->setPrenom('Catherine');
        $bell->setPhoto('images/personnes/catherine_bell.png');
        $bell->addSeriesJouee($soupconDeMagie);

        $bailee = new Personne();
        $bailee->setPrenom('Madion');
        $bailee->setNom('Bailee');
        $bailee->setPhoto('images/personnes/madison_bailee.png');
        $bailee->addSeriesJouee($soupconDeMagie);

        $denton->addSeriesJouee($soupconDeMagie);

        //------ Saisons
        $soupconSaison1 = new Saison();
        $soupconSaison1->setSerie($soupconDeMagie);
        $soupconSaison1->setNumero(1);
        $soupconSaison1->setNbEpisodes(10);
        $soupconSaison1->setAffiche('images/series/soupcon_de_magie1.png');

        $soupconSaison2 = new Saison();
        $soupconSaison2->setSerie($soupconDeMagie);
        $soupconSaison2->setNumero(2);
        $soupconSaison2->setNbEpisodes(12);
        $soupconSaison2->setAffiche('images/series/soupcon_de_magie2.png');

        $soupconSaison3 = new Saison();
        $soupconSaison3->setSerie($soupconDeMagie);
        $soupconSaison3->setNumero(3);
        $soupconSaison3->setNbEpisodes(12);
        $soupconSaison3->setAffiche('images/series/soupcon_de_magie3.png');

        $soupconSaison4 = new Saison();
        $soupconSaison4->setSerie($soupconDeMagie);
        $soupconSaison4->setNumero(4);
        $soupconSaison4->setNbEpisodes(12);
        $soupconSaison4->setAffiche('images/series/soupcon_de_magie4.png');

        $soupconSaison5 = new Saison();
        $soupconSaison5->setSerie($soupconDeMagie);
        $soupconSaison5->setNumero(5);
        $soupconSaison5->setNbEpisodes(12);
        $soupconSaison5->setAffiche('images/series/soupcon_de_magie5.png');

        $manager->persist($soupconDeMagie);
        $manager->persist($soupconSaison1);
        $manager->persist($soupconSaison2);
        $manager->persist($soupconSaison3);
        $manager->persist($soupconSaison4);
        $manager->persist($soupconSaison5);
        //-----------------------------------------------------------------
        //-------------------------Les Simpson-----------------------------
        $simpson = new Serie();
        $simpson->setTitre('Les Simpson');
        $simpson->addCategory($animation);
        $simpson->addCategory($humour);

        //------ Réalisateur
        $groening = new Personne();
        $groening->setPrenom('Matt');
        $groening->setNom('Groening');
        $groening->addSeriesRealisee($simpson);

        //------ Saisons
        $simpsonsSaison1 = new Saison();
        $simpsonsSaison1->setSerie($simpson);
        $simpsonsSaison1->setNumero(1);
        $simpsonsSaison1->setNbEpisodes(13);
        $simpsonsSaison1->setAffiche("images/series/les_simpson1.png");

        $simpsonsSaison2 = new Saison();
        $simpsonsSaison2->setSerie($simpson);
        $simpsonsSaison2->setNumero(2);
        $simpsonsSaison2->setNbEpisodes(22);
        $simpsonsSaison2->setAffiche("images/series/les_simpson1.png");

        $simpsonsSaison3 = new Saison();
        $simpsonsSaison3->setSerie($simpson);
        $simpsonsSaison3->setNumero(3);
        $simpsonsSaison3->setNbEpisodes(24);
        $simpsonsSaison3->setAffiche("images/series/les_simpson1.png");

        $simpsonsSaison4 = new Saison();
        $simpsonsSaison4->setSerie($simpson);
        $simpsonsSaison4->setNumero(4);
        $simpsonsSaison4->setNbEpisodes(22);
        $simpsonsSaison4->setAffiche("images/series/les_simpson1.png");

        $simpsonsSaison5 = new Saison();
        $simpsonsSaison5->setSerie($simpson);
        $simpsonsSaison5->setNumero(5);
        $simpsonsSaison5->setNbEpisodes(22);
        $simpsonsSaison5->setAffiche("images/series/les_simpson1.png");

        $simpsonsSaison6 = new Saison();
        $simpsonsSaison6->setSerie($simpson);
        $simpsonsSaison6->setNumero(6);
        $simpsonsSaison6->setNbEpisodes(25);
        $simpsonsSaison6->setAffiche("images/series/les_simpson1.png");

        $simpsonsSaison7 = new Saison();
        $simpsonsSaison7->setSerie($simpson);
        $simpsonsSaison7->setNumero(7);
        $simpsonsSaison7->setNbEpisodes(25);
        $simpsonsSaison7->setAffiche("images/series/les_simpson1.png");

        $manager->persist($simpson);
        $manager->persist($simpsonsSaison1);
        $manager->persist($simpsonsSaison2);
        $manager->persist($simpsonsSaison3);
        $manager->persist($simpsonsSaison4);
        $manager->persist($simpsonsSaison5);
        $manager->persist($simpsonsSaison6);
        $manager->persist($simpsonsSaison7);


        //-----------------------------------------------------------------
        //---------------------------Futurama------------------------------
        $futurama = new Serie();
        $futurama->setTitre('Futurama');
        $futurama->addCategory($humour);
        $futurama->addCategory($animation);

        //------ Réalisateur
        $groening->addSeriesRealisee($futurama);

        //------ Saisons
        $futuramaSaison1 = new Saison();
        $futuramaSaison1->setSerie($futurama);
        $futuramaSaison1->setNumero(1);
        $futuramaSaison1->setNbEpisodes(13);
        $futuramaSaison1->setAffiche('images/series/futurama1.png');

        $futuramaSaison2 = new Saison();
        $futuramaSaison2->setSerie($futurama);
        $futuramaSaison2->setNumero(2);
        $futuramaSaison2->setNbEpisodes(19);
        $futuramaSaison2->setAffiche('images/series/futurama1.png');

        $futuramaSaison3 = new Saison();
        $futuramaSaison3->setSerie($futurama);
        $futuramaSaison3->setNumero(2);
        $futuramaSaison3->setNbEpisodes(22);
        $futuramaSaison3->setAffiche('images/series/futurama1.png');

        $futuramaSaison4 = new Saison();
        $futuramaSaison4->setSerie($futurama);
        $futuramaSaison4->setNumero(4);
        $futuramaSaison4->setNbEpisodes(18);
        $futuramaSaison4->setAffiche('images/series/futurama1.png');

        $futuramaSaison5 = new Saison();
        $futuramaSaison5->setSerie($futurama);
        $futuramaSaison5->setNumero(5);
        $futuramaSaison5->setNbEpisodes(16);
        $futuramaSaison5->setAffiche('images/series/futurama1.png');

        $futuramaSaison6 = new Saison();
        $futuramaSaison6->setSerie($futurama);
        $futuramaSaison6->setNumero(6);
        $futuramaSaison6->setNbEpisodes(26);
        $futuramaSaison6->setAffiche('images/series/futurama1.png');

        $futuramaSaison7 = new Saison();
        $futuramaSaison7->setSerie($futurama);
        $futuramaSaison7->setNumero(7);
        $futuramaSaison7->setNbEpisodes(26);
        $futuramaSaison7->setAffiche('images/series/futurama1.png');

        $manager->persist($futurama);
        $manager->persist($futuramaSaison1);
        $manager->persist($futuramaSaison2);
        $manager->persist($futuramaSaison3);
        $manager->persist($futuramaSaison4);
        $manager->persist($futuramaSaison5);
        $manager->persist($futuramaSaison6);
        $manager->persist($futuramaSaison7);


        //-----------------------------------------------------------------
        //---------------------------Goldorak------------------------------
        $goldorak = new Serie();
        $goldorak->setTitre('Goldorak');
        $goldorak->addCategory($animation);

        //------ Saisons
        $goldorakSaison1 = new Saison();
        $goldorakSaison1->setSerie($goldorak);
        $goldorakSaison1->setSynopsis("Vega, Grand Stratéguerre de la planète Stykadès, s''empare d''Euphor, une planète pacifique qu''il va ravager avec sa flotte de soucoupes et de robots géants. Durant l''attaque qui mènera à la destruction finale d''Euphor, la famille royale est exterminée. Actarus, fils du roi et prince, parvient à s''échapper après s''être emparé de Goldorak, le plus perfectionné des robots mis au point par les scientifiques de la planète, et s''enfuit vers la Terre. Il est recueilli par la professeur Procyon qui dirige le Centre de recherches spatiales. Poursuivant sa conquête de nouvelles planètes, Vega établit une base sur la face cachée de la Lune, à partir de laquelle il compte lancer l''offensive sur la planète bleue. Actarus se voit alors dans l''obligation d''utiliser Goldorak afin d''éviter que la Terre subisse le même sort que sa planète natale.");
        $goldorakSaison1->setNumero(1);
        $goldorakSaison1->setNbEpisodes(74);
        $goldorakSaison1->setAffiche('images/series/goldorak.png');

        $manager->persist($goldorak);
        $manager->persist($goldorakSaison1);

        //=========================PERSISTANCE=============================

        $manager->persist($deNiro);
        $manager->persist($narducci);
        $manager->persist($palminteri);
        $manager->persist($cherry);
        $manager->persist($longoria);
        $manager->persist($cross);
        $manager->persist($hatcher);
        $manager->persist($huffman);
        $manager->persist($sheridan);
        $manager->persist($denton);
        $manager->persist($bell);
        $manager->persist($bailee);
        $manager->persist($chabat);
        $manager->persist($lauby);
        $manager->persist($darmon);
        $manager->persist($farrugia);
        $manager->persist($karmann);
        $manager->persist($berberian);
        $manager->persist($burton);
        $manager->persist($selick);
        $manager->persist($wasikowska);
        $manager->persist($depp);
        $manager->persist($hathaway);
        $manager->persist($bonham);
        $manager->persist($baronCohen);
        $manager->persist($bobin);
        $manager->persist($groening);

        $manager->persist($drame);
        $manager->persist($action);
        $manager->persist($thriller);
        $manager->persist($aventure);
        $manager->persist($animation);
        $manager->persist($documentaire);
        $manager->persist($spectacle);
        $manager->persist($comedie);
        $manager->persist($fantastique);
        $manager->persist($horreur);
        $manager->persist($humour);
        $manager->persist($policier);
        $manager->persist($scienceFiction);
        $manager->persist($romance);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1', 'group2'];
    }
}
