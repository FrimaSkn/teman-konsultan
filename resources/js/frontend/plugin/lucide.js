import { createIcons, Menu, Facebook, Instagram, Linkedin, ChevronRight, Check, X, LogOut, UserRound } from 'lucide';

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
      }
    });
}

icons();

window.icons = icons;
