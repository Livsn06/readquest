import 'package:flutter/material.dart';
import 'package:readquest_mobile_app/core/constant/app_color.dart';

class AppTitle extends StatelessWidget {
  const AppTitle({super.key});

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return RichText(
      textAlign: TextAlign.center,
      text: TextSpan(
        style: TextStyle(
          color: Colors.white,
          fontSize: size.width * 0.1,
          fontWeight: FontWeight.bold,
        ),
        children: const <TextSpan>[
          TextSpan(
            text: 'Read',
            style: TextStyle(
              color: TAppColor.bolt_blue,
            ),
          ),
          TextSpan(text: ' Quest'),
        ],
      ),
    );
  }
}
