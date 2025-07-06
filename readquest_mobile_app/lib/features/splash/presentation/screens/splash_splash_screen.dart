import 'package:flutter/material.dart';
import 'package:readquest_mobile_app/core/constant/app_color.dart';

class SplashScreen extends StatelessWidget {
  const SplashScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topRight,
            end: Alignment.bottomLeft,
            colors: TAppColor.backgroundGradient,
          ),
        ),
      ),
    );
  }
}
