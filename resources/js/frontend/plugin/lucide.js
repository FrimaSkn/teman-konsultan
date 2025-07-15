import { createIcons, Menu, Facebook, Instagram, Linkedin, ChevronRight, Check, X, LogOut } from 'lucide';

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
        LogOut
      }
    });
}

icons();

window.icons = icons;
