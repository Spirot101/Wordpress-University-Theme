import "../css/style.scss";

// Our modules / classes
// MobileMenu is for small devices
import MobileMenu from "./modules/MobileMenu";
// HeroSlider powers the slideshow at home page
import HeroSlider from "./modules/HeroSlider";
// Google Maps import
import GoogleMap from "./modules/GoogleMap";
// Search import live search
import Search from "./modules/Search";
import MyNotes from "./modules/MyNotes";
import Like from "./modules/Like";

// Instantiate a new object using our modules/classes
const mobileMenu = new MobileMenu();
const heroSlider = new HeroSlider();
const googleMap = new GoogleMap();
const search = new Search();
const myNotes = new MyNotes();
const like = new Like();