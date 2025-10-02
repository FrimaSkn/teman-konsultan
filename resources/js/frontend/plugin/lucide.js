import {
        createIcons,
        Menu,
        Facebook,
        Instagram,
        Linkedin,
        ChevronRight,
        Check, X,
        LogOut,
        UserRound,
        AlignLeft,
        MessageCircleMore,
        CirclePlus,
        CircleMinus,
        ShoppingCart,
        CircleCheckBig
    } from 'lucide';

const icons = () => {
    createIcons({
      icons: {
        Menu,
        ChevronRight,
        Facebook,
        Instagram,
        Linkedin,
        Check,
        X,
        LogOut,
        UserRound,
        AlignLeft,
        MessageCircleMore,
        CirclePlus,
        CircleMinus,
        ShoppingCart,
        CircleCheckBig
      }
    });
}

icons();

window.icons = icons;
