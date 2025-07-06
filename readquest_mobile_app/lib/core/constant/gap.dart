import 'package:flutter/material.dart';

class Gaps {
  Gaps._();
  static SizedBox height(BuildContext context, double factor) {
    final height = MediaQuery.of(context).size.height;
    return SizedBox(height: height * factor);
  }

  static SizedBox width(BuildContext context, double factor) {
    final width = MediaQuery.of(context).size.width;
    return SizedBox(width: width * factor);
  }
}
