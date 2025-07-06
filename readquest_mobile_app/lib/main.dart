import 'package:flutter/material.dart';
import 'package:readquest_mobile_app/features/splash/presentation/screens/splash_splash_screen.dart';

void main() {
  runApp(const MainApp());
}

class MainApp extends StatelessWidget {
  const MainApp({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      home: SplashScreen(),
    );
  }
}
