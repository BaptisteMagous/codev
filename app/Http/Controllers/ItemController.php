<?php

namespace App\Http\Controllers;

use App\Models\Itemtype;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{

    public function index($type = 0)
    {

        $equipements = [ [2, 'Arc'], [3, 'Baguette'], [4, 'Bâton'], [5, 'Dague'], [6, 'Épée'], [22, 'Faux'], [19, 'Hache'], [7, 'Marteau'], [20, 'Outil'], [8, 'Pelle'], [21, 'Pioche'], [83, 'Pierre d\'âme'], [1, 'Amulette'], [9, 'Anneau'], [11, 'Bottes'], [82, 'Bouclier'], [17, 'Cape'], [81, 'Sac à dos'], [10, 'Ceinture'], [16, 'Chapeau'], [18, 'Familier'], [121, 'Montilier'], [23, 'Dofus'], [151, 'Trophée'], [217, 'Prysmaradite'], [99, 'Filet de capture'], [114, 'Arme magique'] ];

        $consummables = [[37, 'Bière'], [79, 'Boisson'], [176, 'Boîte de fragments'], [216, 'Bourse de Kamas'], [89, 'Cadeau'], [172, 'Coffre'], [169, 'Compagnon'], [184, 'Conteneur'], [199, 'Costume'], [25, 'Document'], [74, 'Fée d\'artifice'], [157, 'Figurine'], [115, 'Fragment d\'Âme de Shushu'], [42, 'Friandise'], [190, 'Harnachement'], [166, 'Mimibiote'], [14, 'Objet de dons'], [80, 'Objet de mission'], [203, 'Objet invisible'], [94, 'Objet utilisable'], [226, 'Objet utilisable de Temporis'], [113, 'Objet vivant'], [177, 'Objet d\'apparat'], [93, 'Objet d\'élevage'], [118, 'Objets d\'équipement'], [72, 'Oeuf de familier'], [33, 'Pain'], [76, 'Parchemin de caractéristique'], [87, 'Parchemin de recherche'], [75, 'Parchemin de sortilège'], [200, 'Parchemin de titre'], [173, 'Parchemin d\'attitude'], [188, 'Parchemin d\'émoticônes'], [13, 'Parchemin d\'expérience'], [222, 'Parchemin d\'ornement'], [223, 'Parchemins Temporis'], [85, 'Pierre d\'Âme pleine'], [88, 'Pierre magique'], [49, 'Poisson comestible'], [218, 'Popoche de Havre-Sac'],[12, 'Potion'], [165, 'Potion de conquête'], [116, 'Potion de familier'], [122, 'Potion de montilier'], [206, 'Potion de monture'], [43, 'Potion de téléportation'], [214, 'Potion d\'attitude'], [86, 'Potion d\'oubli Percepteur'], [112, 'Prisme'], [100, 'Sac de ressources'], [69, 'Viande comestible'], [187, 'Viande primitive']];

        $ressources = [ [104, 'Aile'], [40, 'Alliage'], [38, 'Bois'], [108, 'Bourgeon'], [107, 'Carapace'], [174, 'Carte'], [197, 'Caution'], [34, 'Céréale'], [97, 'Certificat de Dragodinde'], [196, 'Certificat de Muldo'], [207, 'Certificat de Volkorne'], [119, 'Champignon'], [84, 'Clef'], [180, 'Concoction'], [111, 'Coquille'], [56, 'Cuir'], [96, 'Écorce'], [154, 'Emballage'], [167, 'Essence de gardien de donjon'], [55, 'Étoffe'], [52, 'Farine'], [35, 'Fleur'], [175, 'Fragment de carte'], [46, 'Fruit'], [152, 'Galet'], [110, 'Gelée'], [58, 'Graine'], [60, 'Huile'], [178, 'Idole'], [182, 'Jus de Poisson'], [68, 'Légume'], [57, 'Laine'], [71, 'Matériel d\'alchimie'], [195, 'Matériel d\'exploration'], [66, 'Métaria'], [39, 'Minerai'], [209, 'Nourriture pour familier'], [153, 'Nowel'], [109, 'Oeil'], [105, 'Oeuf'], [189, 'Orbe de forgemagie'], [106, 'Oreille'], [47, 'Os'], [103, 'Patte'], [59, 'Peau'], [61, 'Peluche'], [51, 'Pierre brute'], [50, 'Pierre précieuse'], [95, 'Planche'], [36, 'Plante'], [53, 'Plume'], [54, 'Poil'], [41, 'Poisson'], [62, 'Poisson vidé'], [26, 'Potion de forgemagie'], [48, 'Poudre'], [179, 'Préparation'], [65, 'Queue'], [158, 'Rabmablague Caramel'], [160, 'Rabmablague Citron'], [159, 'Rabmablague Fraise'], [162, 'Rabmablague Kola'], [163, 'Rabmablague Nougat'], [161, 'Rabmablague Orange'], [98, 'Racine'], [219, 'Ressources des Songes'] ,[15, 'Ressources diverses'], [78, 'Rune de forgemagie'], [212, 'Rune de corruption'], [211, 'Rune de transcendance'], [185, 'Sève'], [125, 'Souvenir'], [183, 'Substrat'], [70, 'Teinture'], [164, 'Vêtement'], [63, 'Viande'], [64, 'Viande conservée'], [181, 'Viande Hachée'], [186, 'Viande Périmée']];

        $questItems = [ [24, 'Divers'], [27, 'Objet de Mutation'], [28, 'Nourriture boost'], [29, 'Bénédiction'], [30, 'Malédiction'], [31, 'Roleplay Buffs'], [32, 'Personnage suiveur'], [126, 'Quêtes principales'], [127, 'Quêtes de temple'], [129, 'Alignement'], [130, 'Ordres des cités'], [131, 'Événements'], [132, 'Archipel de Vulkania'], [133, 'Astrub'], [134, 'Quêtes des cités'], [136, 'Campement des Bworks'], [137, 'Cania'], [138, 'Château d\'Amakna'], [139, 'Île de Frigost'], [140, 'Île d\'Otomaï'], [141, 'Île de Nowel'], [142, 'Incarnam'], [143, 'Montagne des Koalaks'], [144, 'Pandala'], [145, 'Port de Madrestam'], [146, 'Province d\'Amakna'], [147, 'Krosmoz'], [148, 'Jetons'], [149, 'Île de Moon'], [150, 'Îles des Wabbits'], [155, 'Sufokia'], [156, 'Almanax'], [168, 'Justiciers'], [171, 'Dimensions Divines'], [198, 'Saharach'], [201, 'Nimotopia'], [202, 'Sidimote'], [205, 'Tours de la Fratrie'], [213, 'Île de Pwâk'], [215, 'Archipel des Écailles'], [220, 'Eliocalypse'], [225, 'Temporis'] ] ;

        $superTypes = [ [1, 'Equipements', $equipements], [2, 'Consommables', $consummables],[3, 'Ressources', $ressources],[4, 'Quêtes', $questItems]];

        if($type == 0){
            $items = Item::take(50)->get();
        }else{
            $items = Item::where('typeId', $type)->orderBy('level','desc')->take(500)->get();
        }

        return view('items', compact('items', 'superTypes', 'type'));
    }

    public function show($id)
    {
        $item = Item::find($id);
        return view('item', compact('item'));
    }

    public function showDetails($id)
    {
        $item = Item::find($id);
        return view('itemDetails', compact('item'));
    }
}
