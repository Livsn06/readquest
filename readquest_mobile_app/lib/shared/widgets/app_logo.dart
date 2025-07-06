import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';

class AppLogo extends StatelessWidget {
  const AppLogo({super.key});

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return SvgPicture.asset(
      'assets/logo/rq_logo.svg',
      width: size.width * 0.3,
    );
  }
}
