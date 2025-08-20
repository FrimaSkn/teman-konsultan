import { createIcons, Menu, Facebook, Instagram, Linkedin, ChevronRight, Check, X, LogOut, UserRound, AlignLeft } from 'lucide';

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
        AlignLeft
      }
    });
}

icons();

window.icons = icons;
