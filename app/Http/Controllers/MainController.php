<?php /** @noinspection PhpUndefinedMethodInspection */

namespace App\Http\Controllers;

use App\Models\Abusereason;
use App\Models\Achievementcategory;
use App\Models\Alignmentbalance;
use App\Models\Alignmenteffect;
use App\Models\Alignmentgift;
use App\Models\Alignmentorder;
use App\Models\Alignmentside;
use App\Models\Alignmenttitle;
use App\Models\Almanaxcalendar;
use App\Models\Appearance;
use App\Models\Area;
use App\Models\Achievement;
use App\Models\AchievementcategoriesAchievementid;
use App\Models\Achievementobjective;
use App\Models\Achievementreward;
use App\Models\Alignmentrank;
use App\Models\AlignmentrankGift;
use App\Models\AlignmenttitlesNamesid;
use App\Models\AlignmenttitlesShortsid;
use App\Models\AlmanaxcalendarsBonusesid;
use App\Models\Arenaleague;
use App\Models\Arenaleagueseason;
use App\Models\Bonusescriterion;
use App\Models\BonusesCriterionsid;
use App\Models\BreachbossesIncompatibleboss;
use App\Models\Breachinfinitylevel;
use App\Models\Breachprize;
use App\Models\Breachworldmapcoordinate;
use App\Models\Breachworldmapsector;
use App\Models\Breed;
use App\Models\Breedrole;
use App\Models\BreedsBreedrole;
use App\Models\BreedsBreedspellsid;
use App\Models\Challenge;
use App\Models\ChallengeIncompatiblechallenge;
use App\Models\Characteristic;
use App\Models\CharacteristiccategoriesCharacteristicid;
use App\Models\Characteristiccategory;
use App\Models\Chatchannel;
use App\Models\Companion;
use App\Models\Companioncharacteristic;
use App\Models\CompanionsCharacteristic;
use App\Models\CompanionsSpell;
use App\Models\Creaturebonesoverride;
use App\Models\Creaturebonestype;
use App\Models\Custommodebreedspell;
use App\Models\Darecriteria;
use App\Models\DungeonsMapid;
use App\Models\Effect;
use App\Models\Emblemsymbolcategory;
use App\Models\Emoticon;
use App\Models\EmoticonsAnim;
use App\Models\EvolutiveeffectsProgressionperlevelrange;
use App\Models\Externalnotification;
use App\Models\Finishmove;
use App\Models\Havenbagtheme;
use App\Models\Hintcategory;
use App\Models\House;
use App\Models\IdolsIncompatiblemonster;
use App\Models\IdolsSynergyidolsid;
use App\Models\Infomessage;
use App\Models\Interactive;
use App\Models\Item;
use App\Models\ItemsDropmonsterid;
use App\Models\ItemsDroptemporismonsterid;
use App\Models\Itemset;
use App\Models\ItemsetsEffect;
use App\Models\ItemsetsEffectsValue;
use App\Models\ItemsetsItem;
use App\Models\ItemsEvolutiveeffectid;
use App\Models\ItemsFavoritesubarea;
use App\Models\ItemsNuggetsbysubarea;
use App\Models\ItemsPossibleeffect;
use App\Models\ItemsRecipeid;
use App\Models\ItemsResourcesbysubarea;
use App\Models\Itemtype;
use App\Models\Job;
use App\Models\LegendarypowerscategoriesCategoryspell;
use App\Models\Legendarytreasurehunt;
use App\Models\MapcoordinatesMapid;
use App\Models\Mapposition;
use App\Models\MappositionsPlaylist;
use App\Models\MappositionsPlaylistsValue;
use App\Models\MappositionsSound;
use App\Models\Monster;
use App\Models\Monsterrace;
use App\Models\MonsterracesMonster;
use App\Models\MonstersDrop;
use App\Models\MonstersGrade;
use App\Models\MonstersIncompatibleidol;
use App\Models\MonstersSpell;
use App\Models\MonstersSubarea;
use App\Models\Monstersuperrace;
use App\Models\Mount;
use App\Models\Mountbehavior;
use App\Models\Mountfamily;
use App\Models\MountsEffect;
use App\Models\Notification;
use App\Models\Npc;
use App\Models\Npcaction;
use App\Models\Npcmessage;
use App\Models\NpcsAction;
use App\Models\NpcsAnimfunlist;
use App\Models\NpcsDialogmessage;
use App\Models\NpcsDialogmessagesValue;
use App\Models\NpcsDialogrepliesValue;
use App\Models\NpcsDialogreply;
use App\Models\Ornament;
use App\Models\Pointofinterest;
use App\Models\Quest;
use App\Models\Questcategory;
use App\Models\Questobjective;
use App\Models\Questobjectivetype;
use App\Models\Queststep;
use App\Models\RandomdropgroupsRandomdropitem;
use App\Models\Rankname;
use App\Models\Server;
use App\Models\ServercommunitiesDefaultcountry;
use App\Models\ServercommunitiesSupportedlangid;
use App\Models\Servercommunity;
use App\Models\Servergametype;
use App\Models\Serverlang;
use App\Models\Serverpopulation;
use App\Models\ServersRestrictedtolanguage;
use App\Models\Servertemporisseason;
use App\Models\Skill;
use App\Models\SkillsCraftableitemid;
use App\Models\SkillsModifiableitemtypeid;
use App\Models\SkinpositionsTransformation;
use App\Models\SmileysTrigger;
use App\Models\Spell;
use App\Models\Spelllevel;
use App\Models\Spellstate;
use App\Models\Spelltype;
use App\Models\Subarea;
use App\Models\SubareasAmbientsound;
use App\Models\SubareasCustomworldmap;
use App\Models\SubareasHarvestable;
use App\Models\SubareasMapid;
use App\Models\SubareasMonster;
use App\Models\SubareasNpc;
use App\Models\SubareasNpcsValue;
use App\Models\SubareasPlaylist;
use App\Models\SubareasPlaylistsValue;
use App\Models\SubareasQuest;
use App\Models\SubareasShape;
use App\Models\Text;
use Hamcrest\Internal\SelfDescribingValue;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function request(Request $request){
        switch($request->input('requestType')){
            case "data":
                return $this->requestData($request);
            case "data_recyclor":
                return $this->requestDataRecyclor($request);
            case "page":
                return $this->getPageContent($request);
            case "recyclorArea":
                return $this->getRecyclorArea($request);
        }
        return [];
    }

    public function getRecyclorArea(Request $request){
        return response()->json(Subarea::select('subareas.id as id', 'text as name')
            ->join('texts', 'nameId', '=', 'texts.id')
            ->where('text', 'like', '%' . $request->input('text') . '%')
            ->limit(3)->get()
        );
    }

    public function requestDataRecyclor(Request $request){
        $query = $request->input('query');
        $items = Item::select('items.id', 'text as name', 'iconId', 'price')
            ->orderBy($query["orderBy"], ($query["orderDesc"] == "true")?'asc':'desc')
            ->join('texts', 'nameId', '=', 'texts.id')
            ->where('typeId', $query["categorie"])
            ->skip($query["skip"])->take($query["take"])->get();

        foreach ($items as $item){
            $item->recycle = $item->getNuggetsByAreaData();
        }

        return response()->json(['query'=> $items]);
    }

    /* AJAX Request - Compile incoming request and return the result*/
    public function requestData(Request $request)
    {
        $query = $request->input('query');

        if(!isset($query["where"])){
            $query["where"] = [];
        }

        $log = "";

        $selector = $query["orderBy"];
        $order = (($query["orderDesc"] == "true")?'asc':'desc');
        try {
            $id = "id";
            $text = "id";
            $nameId = "nameId";
            $iconId = "iconId";
            $tableName = $query['table'];
            $query['table'] = strtolower($query['table']);
            switch($tableName){
                case "TABLES W/ TEXT & W ICON_ID":
                case "Achievements":
                case "ArenaLeagues":
                    if($tableName == 'ArenaLeagues') $iconId = "icon";
                case "BreachWorldMapSectors":
                    if($tableName == 'BreachWorldMapSectors') $nameId = "sectorNameId";
                    if($tableName == 'BreachWorldMapSectors') $iconId = "sectorIcon";
                case "Breeds":
                    if($tableName == 'Breeds') $nameId = "shortNameId";
                    if($tableName == 'Breeds') $iconId = "breeds.id";
                case "BreedRoles":
                    if($tableName == 'BreedRoles') $iconId = "breedroles.assetId";
                case "Characteristics":
                    if($tableName == 'Characteristics') $iconId = "characteristics.asset";
                case "Companions":
                    if($tableName == 'Companions') $iconId = "companions.assetId";
                case "ExternalNotifications":
                    if($tableName == 'ExternalNotifications') $nameId = "descriptionId";
                case "Hints":
                    if($tableName == 'Hints') $iconId = "hints.gfx";
                case "Houses":
                    if($tableName == 'Houses') $id = "typeId";
                    if($tableName == 'Houses') $iconId = "houses.gfxId";
                case "SpellStates":
                    if($tableName == 'SpellStates') $iconId = "spellstates.icon";

                    $datas = \DB::table($query['table'])->select($query['table'] . '.' . $id . ' as id', 'text as title', \DB::raw($query['table']. "." . $selector . ' as subtitle'), $iconId . ' as iconId')
                        ->orderBy($selector, $order)
                        ->join('texts', $nameId, '=', 'texts.id')
                        ->where($query["where"])
                        ->where('text', 'like', $query["nameFilter"])
                        ->skip($query["skip"])->take($query["take"])->get();
                    break;


                case "TABLES W/ TEXT & W/O ICON_ID":
                case 'AlignmentBalance':
                case 'AlignmentRank':
                case 'AlignmentGift':
                case 'AlignmentEffect':
                    if($tableName == 'AlignmentEffect') $nameId = "descriptionId";
                case 'AlignmentOrder':
                case 'AlignmentSides':
                case "AlmanaxCalendars":
                case "AchievementCategories":
                case "Areas":
                case "ArenaLeagueSeasons":
                case "BreachInfinityLevels":
                case "BreachPrizes":
                case "Challenge":
                case "CharacteristicCategories":
                case "ChatChannels":
                case "CreatureBonesTypes":
                case "CreatureBonesOverrides":
                case "DareCriterias":
                case "Documents":
                    if($tableName == 'Documents') $nameId = "titleId";
                case "Dungeons":
                case "Effects":
                    if($tableName == 'Effects') $nameId = "descriptionId";
                case "EmblemSymbolCategories":
                case "Emoticons":
                case "FinishMoves":
                case "HavenbagThemes":
                case "HintCategory":
                case "InfoMessages":
                    if($tableName == 'InfoMessages') $nameId = "textId";
                case "Interactives":
                case "ItemSets":
                case "Jobs":
                case "LegendaryTreasureHunts":
                case "MapPositions":
                case "MonsterRaces":
                case "MonsterSuperRaces":
                case "Months":
                case "MountBehaviors":
                case "MountFamily":
                case "Mounts":
                case "Notifications":
                    if($tableName == 'Notifications') $nameId = "titleId";
                case "Npcs":
                case "Ornaments":
                case "PointOfInterest":
                case "Quests":
                case "QuestCategory":
                case "RankNames":
                case "ServerCommunities":
                case "ServerGameTypes":
                case "ServerLangs":
                case "Servers":
                case "ServerPopulations":
                case "Signs":
                case "Skills":
                case "Spells":
                case "SubAreas":
                case "SuperAreas":
                case "Texts":
                case "Tips":

                    $datas = \DB::table($query['table'])->select($query['table'] . '.' . $id . ' as id', 'text as title', \DB::raw($query['table']. "." . $selector . ' as subtitle'))
                        ->orderBy($selector, $order)
                        ->join('texts', $nameId, '=', 'texts.id')
                        ->where($query["where"])
                        ->where('text', 'like', $query["nameFilter"])
                        ->skip($query["skip"])->take($query["take"])->get();
                    break;


                case "TABLES W/O TEXT & W/O ICON_ID":
                case 'AlignmentTitles':
                    if($tableName == 'AlignmentTitles') $id = "sideId";
                    if($tableName == 'AlignmentTitles') $text = "sideId";
                case "Appearances":
                case "AbuseReasons":
                case "Bonuses":
                case "BreachBosses":
                case "BreachWorldMapCoordinates":
                case "BreachDungeonModificators":
                case "CensoredContents":
                case "CensoredWords":
                case "CharacterXPMappings":
                case "CustomModeBreedSpells":
                case "EmblemBackgrounds":
                case "EmblemSymbols":
                case "EvolutiveEffects":
                case "EvolutiveItemTypes":
                case "ForgettableSpells":
                case "HavenbagFurnitures":
                case "Heads":
                case "Idols":
                case "Incarnation":
                case "LegendaryPowersCategories":
                case "LivingObjectSkinJntMood":
                case "LuaFormulas":
                case "MapCoordinates":
                case "MapScrollActions":
                case "MapReferences":
                case "MonsterMiniBoss":
                case "NamingRules":
                case "Npcs_DialogMessages":
                case "Npcs_DialogMessages_Value":
                    if($tableName == 'Npcs_DialogMessages_Value') $selector = "value";
                case "OptionalFeatures":
                case "Pack":
                case "RandomDropGroups":
                case "Recipes":
                case "RideFood":
                case "ServerTemporisSeasons":
                    if($tableName == 'ServerTemporisSeasons') $id = "uid";
                    if($tableName == 'ServerTemporisSeasons') $text = "information";
                case "SkinMappings":
                case "SkinPositions":
                case "Smileys":
                case "SoundBones":
                case "SpeakingItemsText":
                case "SpeakingItemsTriggers":
                case "Subhints":
                case "TaxCollectorFirstnames":
                case "TaxCollectorNames":
                case "Titles":
                case "VeteranRewards":
                case "Waypoints":
                case "WorldMaps":

                    $datas = \DB::table($query['table'])->select($id . ' as id', $text . ' as title', $selector . ' as subtitle')
                        ->orderBy($selector, $order)
                        ->where($query["where"])
                        ->skip($query["skip"])->take($query["take"])->get();
                break;

                case "Monsters":
                    $log .= " YES ";
                    $datas = MonstersGrade::select('monsterId as id', 'monsterId as iconId', 'text as title', \DB::raw($selector . ' as subtitle'))
                        ->orderBy($selector, $order)
                        ->join('monsters', 'monsters.id', '=', 'monsters_grades.monsterId')
                        ->join('texts', 'monsters.nameId', '=', 'texts.id')
                        ->groupBy('monsters_grades.monsterId')
                        ->where($query["where"])
                        ->where('text', 'like', $query["nameFilter"])
                        ->skip($query["skip"])->take($query["take"])->get();
                    break;
                case "Items":
                    $datas = Item::select('items.id as id', 'iconId', 'text as title', \DB::raw($selector . ' as subtitle'))
                        ->orderBy($selector, $order)
                        ->join('texts', 'items.nameId', '=', 'texts.id')
                        ->where($query["where"])
                        ->where('text', 'like', $query["nameFilter"])
                        ->skip($query["skip"])->take($query["take"])->get();
                    break;
                case "ItemTypes":
                    $datas = Itemtype::select('itemtypes.id as id', 'text as title', \DB::raw($selector . ' as subtitle'))
                        ->orderBy($selector, $order)
                        ->join('texts', 'itemtypes.nameId', '=', 'texts.id')
                        ->where($query["where"])
                        ->where('text', 'like', $query["nameFilter"])
                        ->skip($query["skip"])->take($query["take"])->get();
                    break;
                default:
                    return response()->json(['error' => "Table non supportée : " . $query["table"]]);

            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }

        return response()->json(['query'=> $datas, 'log' => $log]);
    }

    /* Called when an element is clicked on the query list or browsed from a page (referrence) */
    public function  getPageContent(Request $request)
    {
        $table = $request->input('table');
        $id = $request->input('id');
        $language = $request->input('language');

        $html = "";
        $links = [];
        $arianne = "-TO-DO-";
        $shareLink = "docfus.fr/l/" . $table . "/" . $id;

        switch($table){
            case "Monsters":
                $data = Monster::find($id);
                array_push($links, ['links/dofus.com.png', 'https://www.dofus.com/fr/mmorpg/encyclopedie/monstres/' . $id, 'voir sur dofus.com']);
                break;
            case "Items":
                $data = Item::find($id);
                break;
            case "ItemTypes":
                $data = Itemtype::find($id);
                break;
            case "Spells":
                $data = Spell::find($id);
                break;
            case "SpellStates":
                $data = Spellstate::find($id);
                break;
            case "SpellTypes":
                $data = Spelltype::find($id);
                break;
            case "Houses":
                $data = House::find($id);
                break;
            case "Breeds":
                $data = Breed::find($id);
                break;
            case "MonsterRaces":
            case "MonsterRaceUnlimited": // Monster race without limiting the monster list
                $data = Monsterrace::find($id);
                break;
            case "MonsterSuperRaces":
                $data = Monstersuperrace::find($id);
                break;
            case "Areas":
                $data = Area::find($id);
                break;
            case "SubAreas":
                $data = Subarea::find($id);
                break;
            case "Servers":
                $data = Server::find($id);
                break;
            case "ServerCommunities":
                $data = Servercommunity::find($id);
                break;
            case "ServerGameTypes":
                $data = Servergametype::find($id);
                break;
            case "ServerLangs":
                $data = Serverlang::find($id);
                break;
            case "ServerTemporisSeasons":
                $data = Servertemporisseason::find($id);
                break;
            case "ServerPopulations":
                $data = Serverpopulation::find($id);
                break;
            case "Effects":
            case "EffectsUnlimited":
                $data = Effect::find($id);
                break;
            case "Characteristics":
                $data = Characteristic::find($id);
                break;
            case "CharacteristicCategories":
                $data = Characteristiccategory::find($id);
                break;
            case "Achievements":
                $data = Achievement::find($id);
                break;
            case "Npcs":
                $data = Npc::find($id);
                break;
            case "NpcActions":
                $data = Npcaction::find($id);
                break;
            case "Npcs_DialogMessages":
                $data = NpcsDialogmessage::find($id);
                break;
            case "Npcs_DialogMessages_Value":
                $data = NpcsDialogmessagesValue::find($id);
                break;
            case "Quests":
                $data = Quest::find($id);
                break;
            case "QuestCategory":
                $data = Questcategory::find($id);
                break;
            case "MapPositions":
                $data = Mapposition::find($id);
                break;
            case "Jobs":
                $data = Job::find($id);
                break;
            case "Skills":
                $data = Skill::find($id);
                break;
            case "Texts":
                $data = Text::find($id);
                break;
                /*
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "quest/" . $id, ""]);

                array_push($pageContents, ["list", [], "Etapes"]);
                foreach (Queststep::select('id')->where('questId', $id)->get() as $data){
                    array_push($pageContents[1][1],["flex", "quest/step/" . $data->id, ""]);
                }
            break;


            case 'AlignmentTitles':
                $data = Alignmenttitle::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "alignment/title/" . $id, ""]);

                array_push($pageContents, ["list", [], "Noms"]);
                foreach (AlignmenttitlesNamesid::select('value')->where('AlignmentTitles_id', $id)->get() as $data){
                    array_push($pageContents[1][1],["flex", "alignment/name/" . $data->value, ""]);
                }

                array_push($pageContents, ["list", [], "Short"]);
                foreach (AlignmenttitlesShortsid::select('value')->where('AlignmentTitles_id', $id)->get() as $data){
                    array_push($pageContents[2][1],["flex", "alignment/short/" . $data->value, ""]);
                }
                break;

            case "Appearances":
                $data = Appearance::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "appearance/" . $id, ""]);
            break;

            case "AbuseReasons":
                $data = Abusereason::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "abuseReason/" . $id, ""]);
            break;

            case "Bonuses":
                $data = Bonus::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "bonus/" . $id, ""]);

                array_push($pageContents, ["list", [], "Bonus"]);
                foreach (BonusesCriterionsid::select('value')->where('Bonuses_id', $id)->get() as $data){
                    array_push($pageContents[1][1],["flex", "bonus/criteria/" . $data->value, ""]);
                }
            break;

            case "BreachBosses":
                $data = AlignmentGift::find($id); // TODO : Changer les tables sur lesquels récuperer les nameId
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "breach/boss/" . $id, ""]);

                array_push($pageContents, ["list", [], "Incompatibles avec "]);
                foreach (BreachbossesIncompatibleboss::select('value')->where('BreachBosses_id', $id)->get() as $data){
                    array_push($pageContents[1][1],["flex", "breach/boss/" . $data->value, ""]);
                }
            break;

            case "BreachWorldMapCoordinates":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "breach/coordinate/" . $id, ""]);
                break;

            case "BreachDungeonModificators":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "breach/modificator/" . $id, ""]);
                break;

            case "CensoredContents":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "censor/content/" . $id, ""]);
                break;

            case "CensoredWords":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "censor/word/" . $id, ""]);
                break;

            case "CharacterXPMappings":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "characterXPMapping/" . $id, ""]);
                break;

            case "EmblemBackgrounds":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "emblem/background/" . $id, ""]);
                break;

            case "EmblemSymbols":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "emblem/symbol/" . $id, ""]);
                break;

            case "EvolutiveEffects":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "evolutive/effect/" . $id, ""]);

                array_push($pageContents, ["list", [], ""]);
                foreach (EvolutiveeffectsProgressionperlevelrange::select('id')->where('EvolutiveEffects_id', $id)->get() as $data){
                    array_push($pageContents[1][1],["flex", "evolutive/effect/progression/" . $data->id, ""]);
                }
             break;

            case "EvolutiveItemTypes":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "evolutive/itemType/" . $id, ""]);
                break;

            case "ForgettableSpells":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "forgettableSpell/" . $id, ""]);
                break;

            case "HavenbagFurnitures":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "havenbag/furniture/" . $id, ""]);
                break;

            case "Heads":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "head/" . $id, ""]);
                break;

            case "Idols":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "idol/" . $id, ""]);

                array_push($pageContents, ["list", [], "Synergise avec "]);
                foreach (IdolsSynergyidolsid::select('value')->where('Idols_id', $id)->get() as $data){
                    array_push($pageContents[1][1],["flex", "idol/" . $data->value, ""]);
                }

                array_push($pageContents, ["list", [], "Incompatible avec "]);
                foreach (IdolsIncompatiblemonster::select('value')->where('Idols_id', $id)->get() as $data){
                    array_push($pageContents[2][1],["flex", "monster/miniature/" . $data->value, ""]);
                }
                break;

            case "Incarnation":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "incarnation/" . $id, ""]);
                break;

            case "LegendaryPowersCategories":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "legendaryPower/" . $id, ""]);

                array_push($pageContents, ["list", [], ""]);
                foreach (LegendarypowerscategoriesCategoryspell::select('value')->where('LegendaryPowersCategories_id', $id)->get() as $data){
                    array_push($pageContents[1][1],["flex", "legendaryPower/spell/" . $data->value, ""]);
                }
                break;

            case "LivingObjectSkinJntMood":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "LivingObjectSkinJntMood/" . $id, ""]);
                break;

            case "LuaFormulas":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "luaFormula/" . $id, ""]);
                break;

            case "MapCoordinates":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "map/coordinate/" . $id, ""]);

                array_push($pageContents, ["list", [], ""]);
                foreach (MapcoordinatesMapid::select('value')->where('MapCoordinates_id', $id)->get() as $data){
                    array_push($pageContents[1][1],["flex", "map/" . $data->value, ""]);
                }
                break;

            case "MapScrollActions":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "map/scrollAction/" . $id, ""]);
                break;

            case "MapReferences":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "map/reference/" . $id, ""]);
                break;

            case "MonsterMiniBoss":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "monster/miniBoss/" . $id, ""]);
                break;

            case "NamingRules":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "namingRule/" . $id, ""]);
                break;

            case "OptionalFeatures":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "optionalFeature/" . $id, ""]);
                break;

            case "Pack":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "pack/" . $id, ""]);
                break;

            case "RandomDropGroups":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "randomDropGroup/" . $id, ""]);

                array_push($pageContents, ["list", [], ""]);
                foreach (RandomdropgroupsRandomdropitem::select('id')->where('RandomDropGroups_id', $id)->get() as $data){
                    array_push($pageContents[1][1],["flex", "randomDropGroup/item/" . $data->id, ""]);
                }
                break;

            case "Recipes":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "recipe/" . $id, ""]);
                break;

            case "RideFood":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "rideFood/" . $id, ""]);
                break;

            case "ServerTemporisSeasons":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "server/temporis/" . $id, ""]);
                break;

            case "SkinMappings":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "skin/mapping/" . $id, ""]);
                break;

            case "SkinPositions":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "skin/position/" . $id, ""]);
                break; # TODO : Comprendre ce (et faire la route en passant)

            case "Smileys":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "smiley/" . $id, ""]);

                array_push($pageContents, ["list", [], ""]);
                foreach (SmileysTrigger::select('value')->where('Smileys_id', $id)->get() as $data){
                    array_push($pageContents[1][1],["flex", "smiley/trigger/" . $data->value, ""]);
                }
                break;

            case "SoundBones":
            $data = AlignmentGift::find($id);
            $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "dareCriterias/" . $id, ""]);
                break; # TODO : Comprendre ce (et faire la route en passant)

            case "SpeakingItemsText":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "speakingItem/text/" . $id, ""]);
                break;

            case "SpeakingItemsTriggers":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "speakingItem/trigger/" . $id, ""]);
                break;

            case "Subhints":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "subHint/" . $id, ""]);
                break;

            case "TaxCollectorFirstnames":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "taxCollector/firstName/" . $id, ""]);
                break;

            case "TaxCollectorNames":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "taxCollector/name/" . $id, ""]);
                break;

            case "Titles":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "title/" . $id, ""]);
                break;

            case "VeteranRewards":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "veteranReward/" . $id, ""]);
                break;

            case "Waypoints":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "waypoint/" . $id, ""]);
                break;

            case "WorldMaps":
                $data = AlignmentGift::find($id);
                $arianne = Text::translate($data->nameId, $language);
                array_push($pageContents,["flex", "worldMap/" . $id, ""]);
                break;

            default:
                array_push($pageContents, ["flex", "errors/404", $table]);
                break;*/

        }

        $tables = [
            "Monsters" => ["name_attribut" => "nameId", "view_name" => 'monster.index', "variable_name" => "monster"],
            "Quests" => ["name_attribut" => "nameId", "view_name" => 'quest.index', "variable_name" => "quest"],
            "QuestCategory" => ["name_attribut" => "nameId", "view_name" => 'quest.category.index', "variable_name" => "questCategory"],
            "Items" => ["name_attribut" => "nameId", "view_name" => 'item.index', "variable_name" => "item"],
            "ItemTypes" => ["name_attribut" => "nameId", "view_name" => 'item.type.index', "variable_name" => "itemType"],
            "Spells" => ["name_attribut" => "nameId", "view_name" => 'spell.index', "variable_name" => "spell"],
            "SpellStates" => ["name_attribut" => "nameId", "view_name" => 'spell.state.index', "variable_name" => "spellState"],
            "SpellTypes" => ["name_attribut" => "shortNameId", "view_name" => 'spell.type.index', "variable_name" => "spellType"],
            "Houses" => ["name_attribut" => "nameId", "view_name" => 'house.index', "variable_name" => "house"],
            "Breeds" => ["name_attribut" => "shortNameId", "view_name" => 'breed.index', "variable_name" => "breed"],
            "MonsterRaces" => ["name_attribut" => "nameId", "view_name" => 'monster.race.index', "variable_name" => "monsterRace"],
            "MonsterRaceUnlimited" => ["name_attribut" => "nameId", "view_name" => 'monster.race.index_full', "variable_name" => "monsterRace"],
            "MonsterSuperRaces" => ["name_attribut" => "nameId", "view_name" => 'monster.superrace.index', "variable_name" => "monsterSuperRace"],
            "Areas" => ["name_attribut" => "nameId", "view_name" => 'area.index', "variable_name" => "area"],
            "SubAreas" => ["name_attribut" => "nameId", "view_name" => 'area.sub.index', "variable_name" => "subarea"],
            "Servers" => ["name_attribut" => "nameId", "view_name" => 'server.index', "variable_name" => "server"],
            "ServerCommunities" => ["name_attribut" => "nameId", "view_name" => 'server.community.index', "variable_name" => "serverCommunity"],
            "ServerGameTypes" => ["name_attribut" => "nameId", "view_name" => 'server.type.index', "variable_name" => "serverType"],
            "ServerLangs" => ["name_attribut" => "nameId", "view_name" => 'server.language.index', "variable_name" => "serverLanguage"],
            "ServerTemporisSeasons" => ["name_attribut" => "information", "view_name" => 'server.temporis.index', "variable_name" => "serverTemporis"],
            "ServerPopulations" => ["name_attribut" => "nameId", "view_name" => 'server.population.index', "variable_name" => "serverPopulation"],
            "Effects" => ["name_attribut" => "descriptionId", "view_name" => 'effect.index', "variable_name" => "effect"],
            "EffectsUnlimited" => ["name_attribut" => "descriptionId", "view_name" => 'effect_full.index', "variable_name" => "effect"],
            "Characteristics" => ["name_attribut" => "nameId", "view_name" => 'characteristic.index', "variable_name" => "characteristic"],
            "CharacteristicCategories" => ["name_attribut" => "nameId", "view_name" => 'characteristic.category.index', "variable_name" => "characteristicCategory"],
            "Achievements" => ["name_attribut" => "nameId", "view_name" => 'achievement.index', "variable_name" => "achievement"],
            "Npcs" => ["name_attribut" => "nameId", "view_name" => 'npc.index', "variable_name" => "npc"],
            "NpcActions" => ["name_attribut" => "nameId", "view_name" => 'npc.action.index', "variable_name" => "npcAction"],
            "Npcs_DialogMessages" => ["name_attribut" => "id", "view_name" => 'npc.dialog.index', "variable_name" => "npcDialog"],
            "Npcs_DialogMessages_Value" => ["name_attribut" => "id", "view_name" => 'npc.dialog.value', "variable_name" => "dialogValue"],
            "MapPositions" => ["name_attribut" => "id", "view_name" => 'map.index', "variable_name" => "map"],
            "Jobs" => ["name_attribut" => "nameId", "view_name" => 'job.index', "variable_name" => "job"],
            "Skills" => ["name_attribut" => "nameId", "view_name" => 'skill.index', "variable_name" => "skill"],
            "Texts" => ["name_attribut" => "id", "view_name" => 'text.index', "variable_name" => "text"],
        ];

        $arianne = Text::translate($data[$tables[$table]["name_attribut"]], $language);

        $html = view($tables[$table]["view_name"])->with($tables[$table]["variable_name"], $data)->render();

        return response()->json(['html'=> $html, 'links' => $links, 'arianne' => $arianne, 'table' => $table, 'id' => $id, 'shareLink' => $shareLink]);

    }
}
