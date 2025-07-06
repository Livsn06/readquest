import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:readquest_mobile_app/features/splash/presentation/screens/splash_splash_screen.dart';

void main() {
  group('SplashScreen Widget Tests', () {
    testWidgets('SplashScreen Widget Can Render', (tester) async {
      await tester.pumpWidget(
        const MaterialApp(
          home: SplashScreen(),
        ),
      );
    });
  });
}
