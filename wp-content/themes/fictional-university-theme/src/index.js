import "../css/style.scss"

// Modules / classes
// MobileMenu is for small devices
import MobileMenu from "./modules/MobileMenu"
// HeroSlider powers the slideshow at home page
import HeroSlider from "./modules/HeroSlider"
// Search import live search
import Search from "./modules/Search"

// Instantiate a new object using modules/classes
const mobileMenu = new MobileMenu()
const heroSlider = new HeroSlider()
const search = new Search()
