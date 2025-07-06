import 'package:flutter/material.dart';
import 'package:readquest_mobile_app/core/constant/app_color.dart';
import 'package:readquest_mobile_app/core/constant/gap.dart';
import 'package:readquest_mobile_app/shared/widgets/app_logo.dart';
import 'package:readquest_mobile_app/shared/widgets/app_title.dart';

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
        child: Center(
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              const AppLogo(),
              Gaps.width(context, 0.1),
              const AppTitle(),
            ],
          ),
        ),
      ),
    );
  }
}
