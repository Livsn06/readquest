// ignore_for_file: constant_identifier_names

import 'package:flutter/material.dart';

class TAppColor {
  TAppColor._();

  static const bolt_blue = Color(0xFF08AFFF);
  static const indigo = Color(0xFF1A2568);
  static const yankees_blue = Color(0xFF181E3F);
  static const vivid_violet = Color(0xFFA100FF);

  // Default Colors
  static const errorColor = Color(0xFFff0033);
  static const successColor = Color(0xFF00ff00);
  static const warningColor = Colors.orange;

  // Custom Colors

  // List Colors
  static const List<Color> backgroundGradient = [
    TAppColor.bolt_blue,
    TAppColor.indigo,
    TAppColor.yankees_blue,
    TAppColor.indigo,
    TAppColor.vivid_violet,
  ];
}
