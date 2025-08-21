import { createIcons, Menu, Facebook, Instagram, Linkedin, ChevronRight, Check, X, LogOut, UserRound, AlignLeft, MessageCircleMore  } from 'lucide';

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
        MessageCircleMore
      }
    });
}

icons();

window.icons = icons;
